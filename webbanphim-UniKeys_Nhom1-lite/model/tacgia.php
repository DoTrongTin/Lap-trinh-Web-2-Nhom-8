<?php
function getDataTacGia($page, $limit){
    $conn = connectdb();
    if($conn){
        //tính trang bắt đầu phân trang
        $offset = ($page -1)*$limit;
        //đếm 
        $sqlCount = "SELECT count(*) AS total FROM thuonghieu";
        $sttm = $conn->prepare($sqlCount);
        $sttm->execute();
        $totalRecords = $sttm->fetch(PDO::FETCH_ASSOC)['total'];
        $totalPages = ceil($totalRecords/$limit);

        //load data
        $sql = "SELECT * FROM thuonghieu LIMIT :limit OFFSET :offset";
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

function delDataTacGiaById($idthuonghieu){
    $conn = connectdb();
    if($conn){
        try{
            $sql = "UPDATE thuonghieu SET trangthai = 0 WHERE idthuonghieu = :idthuonghieu";
            $sttm = $conn ->prepare($sql);
            $sttm->bindValue(":idthuonghieu", $idthuonghieu, PDO::PARAM_INT);
            $sttm->execute();
            $result = $sttm->rowCount();
            if($result >0){
                return true;
            }

        }catch(PDOException $e){
            error_log("Lỗi khi cập nhật trạng thái thương hiệu!".$e->getMessage());
        }
    }
    return false;
}

function getComboboxTacGia() {
    $conn = connectdb();
    if ($conn) {
        try {
            $stmt = $conn->prepare("SELECT idthuonghieu, tenthuonghieu FROM thuonghieu WHERE trangthai = 1");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); 
        } catch (PDOException $e) {
            error_log("Lỗi khi lấy danh sách thương hiệu: " . $e->getMessage());
        }
    }
    return false;
}

function themTacGia($tenTacGia, $tieuSu) {
    $conn = connectdb(); // Kết nối cơ sở dữ liệu
    if ($conn) {
        try {
            // Chuẩn bị câu lệnh SQL để thêm dữ liệu
            $stmt = $conn->prepare("
                INSERT INTO thuonghieu (tenthuonghieu, gioithieu, trangthai) 
                VALUES (:tenTacGia, :tieuSu, 1)
            ");

            // Gán giá trị cho các tham số
            $stmt->bindParam(':tenTacGia', $tenTacGia, PDO::PARAM_STR);
            $stmt->bindParam(':tieuSu', $tieuSu, PDO::PARAM_STR);

            // Thực thi truy vấn
            if ($stmt->execute()) {
                return true; // Thêm thành công
            }
        } catch (PDOException $e) {
            // Ghi log lỗi (nếu xảy ra)
            error_log("Lỗi khi thêm thương hiệu: " . $e->getMessage());
        }
    }
    return false; // Thêm thất bại
}

function getTenTacGiaTheoId($idthuonghieu){
    $conn = connectdb();
    if($conn){
        try{
            $sql = "SELECT tenthuonghieu FROM thuonghieu WHERE idthuonghieu = :idthuonghieu";
            $sttm = $conn->prepare($sql);
            $sttm->bindValue('idthuonghieu', $idthuonghieu, PDO::PARAM_INT);
            $sttm->execute();
            $tenthuonghieu = $sttm->fetch(PDO::FETCH_ASSOC)['tenthuonghieu'];
            return $tenthuonghieu;
            
        }catch(PDOException $e){
            error_log(("Lỗi khi gọi tên thương hiệu theo id ".$e->getMessage()));
        }
    }
    return null;
}

function getDataTacGiaTheoId($idthuonghieu){
    $conn = connectdb();
    if($conn){
        try{
            $sql = "SELECT * from thuonghieu WHERE idthuonghieu = :idthuonghieu ";
            $sttm =$conn->prepare($sql);
            $sttm->bindValue(':idthuonghieu', $idthuonghieu, PDO::PARAM_INT);
            $sttm->execute()>0;
            $success = $sttm->rowCount()>0;
            if($success){
                return $sttm->fetch(PDO::FETCH_ASSOC);
            }else{
                return null;
            }

        }catch(PDOException $e){
            error_log("Không tìm thấy thông tin cụ thể của thương hiệu!", $e->getMessage());
        }
    }
    return null;
}

function updateTacgiaById($idthuonghieu, $trangthai){
    $conn = connectdb();
    if($conn){
        try{
            $sql = "UPDATE thuonghieu SET trangthai= :trangthai WHERE idthuonghieu=:idthuonghieu";
            $sttm =$conn->prepare($sql);
            $sttm->bindValue(':trangthai', $trangthai, PDO::PARAM_INT);
            $sttm->bindValue(':idthuonghieu', $idthuonghieu, PDO::PARAM_INT);
            if ($sttm->execute()) {
                return true; 
            }

        }catch(PDOException $e){
            error_log("Lỗi khi cập nhật thương hiệu: ".$e->getMessage());
            return false;
        }
    }
    return false;
}

function checkTrungTenTacGia($tenTacGia) {
    $conn = connectdb(); // Kết nối CSDL
    $sql = "SELECT COUNT(*) FROM thuonghieu WHERE tenthuonghieu = :tenTacGia";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':tenTacGia', $tenTacGia, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn() > 0; // true nếu đã tồn tại
}

function searchTacGia($keyword, $page, $limit) {
    $offset = ($page - 1) * $limit;
    $conn = connectdb();
    $keyword = "%" . $keyword . "%";

    // Đếm tổng kết quả khớp
    $countSql = "SELECT COUNT(*) FROM thuonghieu WHERE tenthuonghieu LIKE :keyword OR idthuonghieu LIKE :keyword";
    $stmt = $conn->prepare($countSql);
    $stmt->bindValue(':keyword', $keyword);
    $stmt->execute();
    $total = $stmt->fetchColumn();

    $totalPages = ceil($total / $limit);

    $sql = "SELECT * FROM thuonghieu WHERE tenthuonghieu LIKE :keyword OR idthuonghieu LIKE :keyword 
            LIMIT :limit OFFSET :offset";
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

function getDataChiTietTacGiaTheoId($idthuonghieu){
    $conn = connectdb();
    if($conn){
        try{
            $sql = "SELECT * FROM thuonghieu WHERE idthuonghieu = :idthuonghieu";
            $sttm = $conn->prepare($sql);
            $sttm->bindValue('idthuonghieu', $idthuonghieu, PDO::PARAM_INT);
            $sttm->execute();
            return $sttm->fetchAll(PDO::FETCH_ASSOC);
            
        }catch(PDOException $e){
            error_log(("Lỗi khi gọi tên thương hiệu theo id ".$e->getMessage()));
        }
    }
    return null;
}
?>
