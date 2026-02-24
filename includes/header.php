<?php
session_start();
$root = '/Keycap_Shop/Lap-trinh-Web-2-Nhom-8/';
$cart_count = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'qty')) : 0;
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KICAP - More Inspirational</title>
    <link rel="stylesheet" href="<?php echo $root; ?>assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <!-- Top bar với logo ở giữa -->
        <div class="top-bar">
            <!-- Hotline bên trái -->
            <div class="hotline">HOTLINE TƯ VẤN: <strong>0369161095</strong></div>

            <!-- Logo chính giữa -->
            <div class="logo-center">
                <img src="<?php echo $root; ?>assets/img/logo3.png" alt="KICAP" class="logo">
            </div>

            <!-- Icons bên phải -->
            <div class="user-icons">
                <a href="#">TÀI KHOẢN</a>
                <a href="#" class="cart">GIỎ HÀNG <span class="badge"><?php echo $cart_count; ?></span></a>
                <a href="#" class="search">Q</a>
            </div>
        </div>

        <!-- Menu navigation (giữ nguyên dưới top-bar) -->
        <nav class="main-nav">
            <ul>
                <li><a href="index.php">TRANG CHỦ</a></li>
                <li><a href="#">BÀN PHÍM CƠ</a></li>
                <li class="dropdown">
                    <a href="#">KEYCAP BỘ ▼</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Keycap Cherry</a></li>
                        <li><a href="#">Keycap SA</a></li>
                    </ul>
                </li>
                <li><a href="#">MÀN HÌNH PC</a></li>
                <li class="dropdown">
                    <a href="#">SẢN PHẨM ▼</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Sản phẩm mới</a></li>
                        <li><a href="#">Bán chạy</a></li>
                    </ul>
                </li>
                <li><a href="#">BÀI VIẾT</a></li>
                <li class="dropdown">
                    <a href="#">VỀ KICAP ▼</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Giới thiệu</a></li>
                        <li><a href="#">Liên hệ</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>