<?php
function getDataNhaXuatBan($page, $limit){
    $conn = connectdb();
    if($conn){
        //tính trang bắt đầu phân trang
        $offset = ($page -1)*$limit;
        //đếm 
        $sqlCount = "SELECT count(*) AS total FROM nhaphanphoi";
        $sttm = $conn->prepare($sqlCount);
        $sttm->execute();
        $totalRecords = $sttm->fetch(PDO::FETCH_ASSOC)['total'];
        $totalPages = ceil($totalRecords/$limit);

        //load data
        $sql = "SELECT * FROM nhaphanphoi LIMIT :limit OFFSET :offset";
        $sttm = $conn->prepare($sql);
        $sttm->bindValue(':limit', $limit, PDO::PARAM_INT);
        $sttm->bindValue(':offset', $offset, PDO::PARAM_INT);
        $sttm-> execute();
        $data= $sttm->fetchAll(PDO::FETCH_ASSOC);

        return[
            'data'=>$data,
            'totalPages'=>$totalPages,
            'currentPage'=>$page

        ];

    }
    return[
        'data'=>[],
        'totalPages'=>[],
        'currentPage'=>1

    ];

}

function delDataNhaXuatBanById($idnhaphaphoi){
    $conn = connectdb();
    if($conn){
        try{
            $sql = "UPDATE nhaphanphoi SET trangthai = 0 WHERE idnhaphaphoi = :idnhaphaphoi";
            $sttm = $conn ->prepare($sql);
            $sttm->bindValue(":idnhaphaphoi", $idnhaphaphoi, PDO::PARAM_INT);
            $sttm->execute();
            $result = $sttm->rowCount();
            if($result >0){
                return true;
            }

        }catch(PDOException $e){
            error_log("Lỗi khi cập nhật trạng thái nhà phân phối!".$e->getMessage());
        }
    }
    return false;
}

function getComboboxNXB() {
    $conn = connectdb();
    if ($conn) {
        try {
            $stmt = $conn->prepare("SELECT idnhaphaphoi, tennpp FROM nhaphanphoi WHERE trangthai = 1");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); 
        } catch (PDOException $e) {
            error_log("Lỗi khi lấy danh sách nhà phân phối: " . $e->getMessage());
        }
    }
    return false;
}

function themNXB($tenNXB, $email, $sodienthoai, $diachi) {
    $conn = connectdb(); // Kết nối cơ sở dữ liệu
    if ($conn) {
        try {
            // Chuẩn bị câu lệnh SQL để thêm dữ liệu
            $stmt = $conn->prepare("
                INSERT INTO nhaphanphoi (tennpp, email, sodienthoai, diachi, trangthai) 
                VALUES (:tenNXB, :email, :sodienthoai, :diachi, 1)
            ");

            // Gán giá trị cho các tham số
            $stmt->bindParam(':tenNXB', $tenNXB, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':sodienthoai', $sodienthoai, PDO::PARAM_STR);
            $stmt->bindParam(':diachi', $diachi, PDO::PARAM_STR);

            // Thực thi truy vấn
            if ($stmt->execute()) {
                return true; // Thêm thành công
            }
        } catch (PDOException $e) {
            // Ghi log lỗi (nếu xảy ra)
            error_log("Lỗi khi thêm nhà phân phối: " . $e->getMessage());
        }
    }
    return false; // Thêm thất bại
}

function getTenNhaXuatBanTheoId($idnhaphaphoi){
    $conn = connectdb();
    if($conn){
        try{
            $sql = "SELECT tennpp FROM nhaphanphoi WHERE idnhaphaphoi = :idnhaphaphoi";
            $sttm = $conn->prepare($sql);
            $sttm->bindValue('idnhaphaphoi', $idnhaphaphoi, PDO::PARAM_INT);
            $sttm->execute();
            $tennpp = $sttm->fetch(PDO::FETCH_ASSOC)['tennpp'];
            return $tennpp;
            
        }catch(PDOException $e){
            error_log(("Lỗi khi gọi tên thương hiệu theo id ".$e->getMessage()));
        }
    }
    return null;
}

function getDataNhaXuaBanTheoId($idnhaphaphoi){
    $conn = connectdb();
    if($conn){
        try{
            $sql = "SELECT * from nhaphanphoi WHERE idnhaphaphoi = :idnhaphaphoi ";
            $sttm =$conn->prepare($sql);
            $sttm->bindValue(':idnhaphaphoi', $idnhaphaphoi, PDO::PARAM_INT);
            $sttm->execute()>0;
            $success = $sttm->rowCount()>0;
            if($success){
                return $sttm->fetch(PDO::FETCH_ASSOC);
            }else{
                return null;
            }

        }catch(PDOException $e){
            error_log("Không tìm thấy thông tin cụ thể của nhà phân phối!", $e->getMessage());
        }
    }
    return null;
}

function updateNhaXuatBanById($idnhaphaphoi, $trangthai){
    $conn = connectdb();
    if($conn){
        try{
            $sql = "UPDATE nhaphanphoi SET trangthai= :trangthai WHERE idnhaphaphoi=:idnhaphaphoi";
            $sttm =$conn->prepare($sql);
            $sttm->bindValue(':trangthai', $trangthai, PDO::PARAM_INT);
            $sttm->bindValue(':idnhaphaphoi', $idnhaphaphoi, PDO::PARAM_INT);
            if ($sttm->execute()) {
                return true; 
            }

        }catch(PDOException $e){
            error_log("Lỗi khi cập nhật nhà phân phối: ".$e->getMessage());
            return false;
        }
    }
    return false;
}

function checkTrungTenAndEmailAndSDTAndDiaChi($tenNXB, $emailNXB, $SDTNXB) {
    $conn = connectdb(); // Kết nối CSDL
    
    // Kiểm tra tên nhà phân phối
    $sqlTen = "SELECT COUNT(*) FROM nhaphanphoi WHERE tennpp = :tenNXB";
    $stmtTen = $conn->prepare($sqlTen);
    $stmtTen->bindParam(':tenNXB', $tenNXB, PDO::PARAM_STR);
    $stmtTen->execute();
    $existsTen = $stmtTen->fetchColumn() > 0; // true nếu tên nhà phân phối đã tồn tại
    
    // Kiểm tra email nhà phân phối
    $sqlEmail = "SELECT COUNT(*) FROM nhaphanphoi WHERE email = :emailNXB";
    $stmtEmail = $conn->prepare($sqlEmail);
    $stmtEmail->bindParam(':emailNXB', $emailNXB, PDO::PARAM_STR);
    $stmtEmail->execute();
    $existsEmail = $stmtEmail->fetchColumn() > 0; // true nếu email đã tồn tại
    
    // Kiểm tra số điện thoại
    $sqlSDT = "SELECT COUNT(*) FROM nhaphanphoi WHERE sodienthoai = :SDTNXB";
    $stmtSDT = $conn->prepare($sqlSDT);
    $stmtSDT->bindParam(':SDTNXB', $SDTNXB, PDO::PARAM_STR);
    $stmtSDT->execute();
    $existsSDT = $stmtSDT->fetchColumn() > 0; // true nếu số điện thoại đã tồn tại

    // Trả về kết quả kiểm tra cho từng trường
    return [
        'tenNXB' => $existsTen,
        'emailNXB' => $existsEmail,
        'SDTNXB' => $existsSDT
    ];
}

function searchNXB($keyword, $page, $limit) {
    $offset = ($page - 1) * $limit;
    $conn = connectdb();
    $keyword = "%" . $keyword . "%";

    // Đếm tổng kết quả khớp
    $countSql = "SELECT COUNT(*) FROM nhaphanphoi WHERE tennpp LIKE :keyword OR idnhaphaphoi LIKE :keyword
                OR email LIKE :keyword OR sodienthoai LIKE :keyword";
    $stmt = $conn->prepare($countSql);
    $stmt->bindValue(':keyword', $keyword);
    $stmt->execute();
    $total = $stmt->fetchColumn();

    $totalPages = ceil($total / $limit);

    $sql = "SELECT * FROM nhaphanphoi WHERE tennpp LIKE :keyword OR idnhaphaphoi LIKE :keyword 
                OR email LIKE :keyword OR sodienthoai LIKE :keyword LIMIT :limit OFFSET :offset";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':keyword', $keyword);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return [
        'data' => $data,
        'totalPages' => $totalPages,
        'currentPage' => $page 
    ];
}
?>
