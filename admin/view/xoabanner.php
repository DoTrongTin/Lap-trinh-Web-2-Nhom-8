<?php
    include_once '../../model/connectDB.php';
    include_once '../../model/banner.php';

    if (isset($_GET['idbanner'])) {
        $id = $_GET['idbanner'];
        if (deleteBannerById($id)) {
            echo "<script>alert('Xóa banner thành công'); window.location.href = '../controller/index.php?pg=cuahang&tabId=tab15';</script>";
        } else {
            echo "<script>alert('Xóa thất bại.'); window.history.back();</script>";
        }
    }    
?>
