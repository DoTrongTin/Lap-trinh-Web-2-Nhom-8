<?php
include_once '../../model/connectDB.php';
include_once '../../model/nhanvien.php';
include_once '../../model/taikhoan.php';

$idnhanvien = isset($_GET['idnhanvien']) ? $_GET['idnhanvien'] : (isset($_POST['idnhanvien']) ? $_POST['idnhanvien']: null);


if($idnhanvien){
    $employee = getDataNhanVienTheoId($idnhanvien);
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $idnhanvien = $_POST['idnhanvien'];
        $trangthai = $_POST['trangthai'];
        if(updateNhanVienById($idnhanvien, $trangthai)){
            updateTaiKhoanByIdChoTrangThai($idnhanvien, $trangthai);
            echo "<script>
            alert('Cập nhật thông tin nhân viên thành công!');
            window.location.href = '../controller/index.php?pg=nhanvien';
            </script>";
        }else{
            echo "<script>alert('Lỗi cập nhật nhân viên!')</script>";
        }

    }

} else {
    echo "Không tìm thấy nhân viên";
}

?>

        <div class="container">
            
            <form action="../controller/index.php?pg=suanhanvien" method="post" >
                <h2>Sửa Nhân viên</h2>
                <button type="button" class="close-button" onclick="location.href='../controller/index.php?pg=nhanvien'">X</button>
                <label for="employeeId"><b>ID</b></label>
                <input type="text"  name="idnhanvien" value="<?=$employee['idnhanvien']?>" readonly>

                <label for="employeeName"><b>Họ tên</b></label>
                <input type="text" name="tennhanvien" value="<?=$employee['ten']?>" readonly>

                <label for="email"><b>Email</b></label>
                <input type="email" name="email" value="<?=$employee['email']?>" readonly>

                <label for="phoneNumber"><b>Số điện thoại</b></label>
                <input type="text" name="phoneNumber" value="<?=$employee['sodienthoai']?>" readonly>

                <label for="phoneNumber"><b>Nhóm quyền</b></label>
                <input type="text" name="phoneNumber" value="<?=$employee['chucvu']?>" readonly>

                <label for="status"><b>Trạng thái</b></label>
                <select name="trangthai" required>
                    <option value="1" <?=$employee['trangthai'] ==1 ? 'selected' : ''?>>Hoạt động</option>
                    <option value="0" <?=$employee['trangthai'] ==0 ? 'selected' : ''?>>Tạm khóa</option>
                </select>

                <button type="submit" class="btn">Cập nhật</button>
            </form>
        </div>
    </div>

    <link rel="stylesheet" href="../view/layout/css/form.css">
</body>

</html>
