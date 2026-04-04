<?php
include_once '../../model/connectDB.php';
include_once '../../model/thuonghieu.php';

$idthuonghieu = isset($_GET['idthuonghieu']) ? $_GET['idthuonghieu'] : (isset($_POST['idthuonghieu']) ? $_POST['idthuonghieu']: null);


if($idthuonghieu){
    $thuonghieu = getDataTacGiaTheoId($idthuonghieu);
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $idthuonghieu = $_POST['idthuonghieu'];
        $trangthai = $_POST['trangthai'];
        if(updateTacgiaById($idthuonghieu, $trangthai)){
            echo "<script>
            alert('Cập nhật thông tin thương hiệu thành công!');
            window.location.href = '../controller/index.php?pg=sanpham&tabId=tab3';
            </script>";
        }else{
            echo "<script>alert('Lỗi cập nhật thương hiệu!')</script>";
        }

    }

} else {
    echo "Không tìm thấy thương hiệu";
}

?>
        <div class="container">
            
            <form action="../controller/index.php?pg=suathuonghieu" method="post">
                <h2>Sửa Thương hiệu</h2>
                <button type="button" class="close-button" onclick="location.href='../controller/index.php?pg=sanpham&tabId=tab3'">X</button>
                <label for="authorId"><b>ID</b></label>
                <input type="text" name="idthuonghieu" value="<?=$thuonghieu['idthuonghieu']?>" readonly>
    
                <label for="authorName"><b>Tên thương hiệu</b></label>
                <input type="text" name="authorName" value="<?=$thuonghieu['tenthuonghieu']?>" readonly>
    
                <label for="bio"><b>Tiểu sử</b></label>
                <textarea name="bio" readonly><?=$thuonghieu['gioithieu']?></textarea>
    
                <label for="status"><b>Trạng thái</b></label>
                <select name="trangthai" required>
                    <option value="1" <?=$thuonghieu['trangthai'] ==1 ? 'selected' : ''?>>Hoạt động</option>
                    <option value="0" <?=$thuonghieu['trangthai'] ==0 ? 'selected' : ''?>>Tạm khóa</option>
                </select>
    
                <button type="submit" class="btn">Cập nhật</button>
            </form>
        </div>
    </div>

    <link rel="stylesheet" href="../view/layout/css/form.css">
</body>
</html>
