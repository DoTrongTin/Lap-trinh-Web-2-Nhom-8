<?php
include_once '../../model/connectDB.php';
include_once '../../model/sanpham.php';
include_once '../../model/danhmuc.php';
include_once '../../model/thuonghieu.php';
include_once '../../model/nhaphanphoi.php';

$idbanphim = isset($_GET['idbanphim']) ? $_GET['idbanphim'] : (isset($_POST['idsanpham']) ? $_POST['idsanpham']: null);
// $idbanphim = isset($_GET['idbanphim']) ? $_GET['idbanphim'] : (isset($_POST['idsanpham']) ? $_POST['idsanpham'] : null);


if($idbanphim){
    $product = getDataSanPhamTheoId($idbanphim);
    $cmbDanhMuc = getComboboxCTDanhMuc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $idbanphim = $_POST['idsanpham'];
        $trangthai = $_POST['trangThai'];
        if (updateSanPhamById($idbanphim, $trangthai)) {
            echo "<script>alert('Cập nhật sản phẩm thành công!'); window.location.href = '../controller/index.php?pg=sanpham&tabId=tab1';</script>";
        } else {
            echo "<script>alert('Cập nhật sản phẩm thất bại! Vui lòng thử lại.');</script>";
        }
    } 
    
} else {
    echo "Không tìm thấy sản phẩm";
}

?>
        <link rel="stylesheet" href="../view/layout/css/form.css">

        <div class="container">
            <form id="editProductForm" enctype="multipart/form-data" action="../controller/index.php?pg=suasach" method="post">
                <button type="button" class="close-button" onclick="location.href='../controller/index.php?pg=sanpham&tabId=tab1'">X</button>
                <h2>Sửa Sản phẩm</h2>
                <div class="row">
                    <label for="productImage"><b>Hình ảnh:</b></label>
                    <div class="image-preview-container">
                        <img id="currentImage" src="../../<?=$product['anhbia']?>" alt="Hình sản phẩm"/>
                    </div>
                </div>
                <label for="idsanpham"><b>ID sản phẩm:</b></label>
                <input type="text" id="idsanpham" name="idsanpham" value="<?=$product['idbanphim']?>" readonly>
        
                <label for="productName"><b>Tên sản phẩm:</b></label>
                <input type="text" id="productName" name="productName" value="<?=$product['tenbanphim']?>" readonly>

                <label for="productName"><b>Thương hiệu:</b></label>
                <input type="text" id="thuonghieu" name="thuonghieu" value="<?=getTenTacGiaTheoId($product['idthuonghieu'])?>" readonly>

                <label for="productName"><b>Nhà phân phối:</b></label>
                <input type="text" id="nhaphanphoi" name="nhaphanphoi" value="<?=getTenNhaXuatBanTheoId($product['idnhaphaphoi'])?>" readonly>
        
                <label for="danhmuc"><b>Danh mục:</b></label>
                <select id="danhmuc" name="danhmuc" disabled>
                    <?php foreach($cmbDanhMuc as $danhmuc):?>
                        <option value="<?=$danhmuc['iddanhmuc']?>" <?=$danhmuc['iddanhmuc'] == $product['idctdanhmuc'] ? 'selected' : ''?>>
                            <?=$danhmuc['tendanhmuc']?>
                        </option>
                    <?php endforeach; ?>
                </select>
        
                <div class="row">
                    <label for="price"><b>Giá:</b></label>
                    <input type="text" id="price" name="price" value="<?=number_format($product['gia'], 0, '.', '.')?>" readonly>
            
                    <label for="quantity"><b>Số lượng:</b></label>
                    <input type="text" id="quantity" name="quantity" value="<?=$product['sltonkho']?>" readonly>
                </div>
        
                <label for="description"><b>Mô tả:</b></label>
                <textarea id="description" name="description" required><?=$product['mota']?></textarea>

                <label for="trangThai"><b>Trạng thái</b></label>
                <select name="trangThai" <?=$product['sltonkho'] == 0 ? 'disabled' : ''?>>
                    <?php if($product['sltonkho'] == 0): ?>
                        <option value="0" selected>Hết hàng</option>
                    <?php else: ?>
                        <option value="1" <?=$product['trangthai'] == 1 ? 'selected' : ''?>>Còn hàng</option>
                    <option value="0" <?=$product['trangthai'] == 0 ? 'selected' : ''?>>Tạm ngưng</option>
                    <?php endif; ?>
                </select>
        
                <button type="submit" class="btn">Cập nhật</button>
            </form>
        </div>        
    </div>
</body>

</html>
