<?php
include_once '../../model/connectDB.php';
include_once '../../model/nhaphanphoi.php';

$idnhaphaphoi = isset($_GET['idnhaphaphoi']) ? $_GET['idnhaphaphoi'] : (isset($_POST['idnhaphaphoi']) ? $_POST['idnhaphaphoi']: null);


if($idnhaphaphoi){
    $nhaphanphoi = getDataNhaXuaBanTheoId($idnhaphaphoi);
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $idnhaphaphoi = $_POST['idnhaphaphoi'];
        $trangthai = $_POST['trangthai'];
        if(updateNhaXuatBanById($idnhaphaphoi, $trangthai)){
            echo "<script>
            alert('Cập nhật thông tin nhà phân phối thành công!');
            window.location.href = '../controller/index.php?pg=sanpham&tabId=tab4';
            </script>";
        }else{
            echo "<script>alert('Lỗi cập nhật nhà phân phối!')</script>";
        }

    }

} else {
    echo "Không tìm thấy nhà phân phối";
}

?>

        <div class="container">
            <form action="../controller/index.php?pg=suanhaphanphoi" method="post">
                <h2>Sửa Nhà phân phối</h2>
                <button type="button" class="close-button" onclick="location.href='../controller/index.php?pg=sanpham&tabId=tab4'">X</button>
                <label for="publisherId"><b>ID</b></label>
                <input type="text" name="idnhaphaphoi" value="<?=$nhaphanphoi['idnhaphaphoi']?>" readonly>

                <label for="publisherName"><b>Tên nhà phân phối</b></label>
                <input type="text" name="publisherName" value="<?=$nhaphanphoi['tennpp']?>" readonly>

                <label for="email"><b>Email</b></label>
                <input type="email" name="email" value="<?=$nhaphanphoi['email']?>" readonly>

                <label for="phoneNumber"><b>Số điện thoại</b></label>
                <input type="text" name="phoneNumber" value="<?=$nhaphanphoi['sodienthoai']?>" readonly>

                <label for="address"><b>Địa chỉ</b></label>
                <input type="text" name="address" value="<?=$nhaphanphoi['diachi']?>" readonly>

                <label for="status"><b>Trạng thái</b></label>
                <select name="trangthai" required>
                    <option value="1" <?=$nhaphanphoi['trangthai'] ==1 ? 'selected' : ''?>>Hoạt động</option>
                    <option value="0" <?=$nhaphanphoi['trangthai'] ==0 ? 'selected' : ''?>>Tạm khóa</option>
                </select>

                <button type="submit" class="btn">Cập nhật</button>
            </form>
        </div>
    </div>

    <link rel="stylesheet" href="../view/layout/css/form.css">
</body>
</html>
