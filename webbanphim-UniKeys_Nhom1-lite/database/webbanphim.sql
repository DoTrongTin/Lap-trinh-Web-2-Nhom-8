-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 29, 2025 lúc 09:24 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu demo cho UniKeys (giữ tên `webbanphim` để tương thích mã nguồn)
--
CREATE DATABASE IF NOT EXISTS `webbanphim` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `webbanphim`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banner`
--

CREATE TABLE `banner` (
  `idbanner` int(11) NOT NULL,
  `hinhanh` varchar(255) NOT NULL,
  `mota` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `banner`
--

INSERT INTO `banner` (`idbanner`, `hinhanh`, `mota`) VALUES
(1, 'img/banner/banner1.webp', 'Giảm đến 30% cho combo bàn phím cơ, keycap và switch hot-swap.'),
(2, 'img/banner/banner2.webp', 'Bộ sưu tập Cherry, OEM và artisan cho mọi layout từ 65% đến fullsize.'),
(3, 'img/banner/banner3.webp', 'Foam, stabilizer, lube và phụ kiện DIY giúp nâng cấp âm gõ dễ dàng.'),
(4, 'img/banner/banner4.webp', 'Từ kit nhôm CNC đến desk setup tối giản cho dân code, designer và gamer.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdanhmuc`
--

CREATE TABLE `chitietdanhmuc` (
  `idchitietdanhmuc` int(11) NOT NULL,
  `iddanhmuc` int(11) NOT NULL,
  `tenchitietdanhmuc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietdanhmuc`
--

INSERT INTO `chitietdanhmuc` (`idchitietdanhmuc`, `iddanhmuc`, `tenchitietdanhmuc`) VALUES
(1, 1, 'Fullsize'),
(2, 1, 'TKL'),
(3, 1, '65%-75%'),
(4, 2, 'Cherry profile'),
(5, 2, 'OEM profile'),
(6, 2, 'Artisan keycap'),
(7, 3, 'Linear'),
(8, 3, 'Tactile'),
(9, 3, 'Clicky'),
(10, 4, 'Barebone hot-swap'),
(11, 4, 'Nhôm CNC'),
(12, 4, 'Alice/Ergo'),
(13, 5, 'Foam mod'),
(14, 5, 'Stabilizer'),
(15, 5, 'Lube & film'),
(16, 6, 'Tối giản'),
(17, 6, 'RGB nổi bật'),
(18, 6, 'Văn phòng'),
(19, 7, 'Wireless'),
(20, 7, 'Ultralight'),
(21, 7, 'Esports'),
(22, 8, 'Switch opener'),
(23, 8, 'Keycap puller'),
(24, 8, 'Dụng cụ hàn'),
(25, 9, 'Cáp cuộn'),
(26, 9, 'Kê tay gỗ'),
(27, 9, 'Kê tay resin'),
(28, 10, 'Bàn phím + keycap'),
(29, 10, 'Starter set mod'),
(30, 10, 'Setup streamer');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `idchitiethoadon` int(11) NOT NULL,
  `idhoadon` int(11) NOT NULL,
  `idbanphim` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `dongia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitiethoadon`
--

INSERT INTO `chitiethoadon` (`idchitiethoadon`, `idhoadon`, `idbanphim`, `soluong`, `dongia`) VALUES
(1, 4, 8, 1, 65000),
(2, 4, 10, 1, 45000),
(3, 4, 9, 1, 110000),
(4, 5, 8, 1, 65000),
(5, 5, 10, 1, 45000),
(6, 5, 24, 1, 110000),
(7, 6, 14, 1, 110000),
(8, 6, 18, 1, 140000),
(9, 6, 9, 2, 110000),
(10, 7, 8, 1, 65000),
(11, 7, 24, 1, 110000),
(12, 7, 9, 1, 110000),
(13, 8, 8, 1, 65000),
(14, 8, 24, 1, 110000),
(15, 8, 10, 1, 45000),
(16, 9, 8, 2, 65000),
(17, 9, 9, 2, 110000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietphieunhap`
--

CREATE TABLE `chitietphieunhap` (
  `idphieunhap` int(11) NOT NULL,
  `idbanphim` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `dongia` int(11) NOT NULL,
  `loinhuan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

CREATE TABLE `danhmuc` (
  `iddanhmuc` int(11) NOT NULL,
  `tendanhmuc` varchar(255) NOT NULL,
  `trangthai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`iddanhmuc`, `tendanhmuc`, `trangthai`) VALUES
(1, 'Bàn phím cơ', 1),
(2, 'Keycap', 1),
(3, 'Switch', 1),
(4, 'Kit bàn phím', 1),
(5, 'Phụ kiện mod', 1),
(6, 'Desk setup', 1),
(7, 'Chuột gaming', 1),
(8, 'DIY & tools', 1),
(9, 'Cáp & kê tay', 1),
(10, 'Combo nổi bật', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `idgiohang` int(11) NOT NULL,
  `idkhachhang` int(11) NOT NULL,
  `idbanphim` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `trangthai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinhanhsach`
--

CREATE TABLE `hinhanhsach` (
  `idhinhanh` int(11) NOT NULL,
  `idbanphim` int(11) NOT NULL,
  `duongdananh` varchar(255) NOT NULL,
  `mota` text NOT NULL,
  `trangthai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hinhanhsach`
--

INSERT INTO `hinhanhsach` (`idhinhanh`, `idbanphim`, `duongdananh`, `mota`, `trangthai`) VALUES
(1, 1, 'img/akko_3098b_plus_black_gold/1.jpg', 'Ảnh góc nghiêng Akko 3098B Plus Black Gold', 1),
(2, 1, 'img/akko_3098b_plus_black_gold/2.jpg', 'Ảnh cận cảnh Akko 3098B Plus Black Gold', 1),
(3, 2, 'img/keychron_v6_max_knob/1.jpg', 'Ảnh góc nghiêng Keychron V6 Max Knob', 1),
(4, 2, 'img/keychron_v6_max_knob/2.jpg', 'Ảnh cận cảnh Keychron V6 Max Knob', 1),
(5, 3, 'img/aula_f99_tri_mode_rgb/1.jpg', 'Ảnh góc nghiêng Aula F99 Tri-Mode RGB', 1),
(6, 3, 'img/aula_f99_tri_mode_rgb/2.jpg', 'Ảnh cận cảnh Aula F99 Tri-Mode RGB', 1),
(7, 4, 'img/monsgeek_m3_tkl_aluminum/1.jpg', 'Ảnh góc nghiêng MonsGeek M3 TKL Aluminum', 1),
(8, 4, 'img/monsgeek_m3_tkl_aluminum/2.jpg', 'Ảnh cận cảnh MonsGeek M3 TKL Aluminum', 1),
(9, 5, 'img/leobog_k81_pro_tkl/1.jpg', 'Ảnh góc nghiêng Leobog K81 Pro TKL', 1),
(10, 5, 'img/leobog_k81_pro_tkl/2.jpg', 'Ảnh cận cảnh Leobog K81 Pro TKL', 1),
(11, 6, 'img/akko_5075b_plus_joy_of_life/1.jpg', 'Ảnh góc nghiêng Akko 5075B Plus Joy of Life', 1),
(12, 6, 'img/akko_5075b_plus_joy_of_life/2.jpg', 'Ảnh cận cảnh Akko 5075B Plus Joy of Life', 1),
(13, 7, 'img/keychron_v1_max_carbon_black/1.jpg', 'Ảnh góc nghiêng Keychron V1 Max Carbon Black', 1),
(14, 7, 'img/keychron_v1_max_carbon_black/2.jpg', 'Ảnh cận cảnh Keychron V1 Max Carbon Black', 1),
(15, 8, 'img/gmk_botanical_clone_pbt_set/1.jpg', 'Ảnh góc nghiêng GMK Botanical Clone PBT Set', 1),
(16, 8, 'img/gmk_botanical_clone_pbt_set/2.jpg', 'Ảnh cận cảnh GMK Botanical Clone PBT Set', 1),
(17, 9, 'img/studio_pbt_olivia_noir/1.jpg', 'Ảnh góc nghiêng Studio PBT Olivia Noir', 1),
(18, 9, 'img/studio_pbt_olivia_noir/2.jpg', 'Ảnh cận cảnh Studio PBT Olivia Noir', 1),
(19, 10, 'img/customlab_retro_beige_keycap/1.jpg', 'Ảnh góc nghiêng CustomLab Retro Beige Keycap', 1),
(20, 10, 'img/customlab_retro_beige_keycap/2.jpg', 'Ảnh cận cảnh CustomLab Retro Beige Keycap', 1),
(21, 11, 'img/artisan_koi_escape_keycap/1.jpg', 'Ảnh góc nghiêng Artisan Koi Escape Keycap', 1),
(22, 11, 'img/artisan_koi_escape_keycap/2.jpg', 'Ảnh cận cảnh Artisan Koi Escape Keycap', 1),
(23, 12, 'img/xda_matcha_thick_pbt_set/1.jpg', 'Ảnh góc nghiêng XDA Matcha Thick PBT Set', 1),
(24, 12, 'img/xda_matcha_thick_pbt_set/2.jpg', 'Ảnh cận cảnh XDA Matcha Thick PBT Set', 1),
(25, 13, 'img/gateron_milky_yellow_pro/1.jpg', 'Ảnh góc nghiêng Gateron Milky Yellow Pro', 1),
(26, 13, 'img/gateron_milky_yellow_pro/2.jpg', 'Ảnh cận cảnh Gateron Milky Yellow Pro', 1),
(27, 14, 'img/akko_cream_blue_v3/1.jpg', 'Ảnh góc nghiêng Akko Cream Blue V3', 1),
(28, 14, 'img/akko_cream_blue_v3/2.jpg', 'Ảnh cận cảnh Akko Cream Blue V3', 1),
(29, 15, 'img/kailh_box_white/1.jpg', 'Ảnh góc nghiêng Kailh Box White', 1),
(30, 15, 'img/kailh_box_white/2.jpg', 'Ảnh cận cảnh Kailh Box White', 1),
(31, 16, 'img/cherry_mx_brown_rgb/1.jpg', 'Ảnh góc nghiêng Cherry MX Brown RGB', 1),
(32, 16, 'img/cherry_mx_brown_rgb/2.jpg', 'Ảnh cận cảnh Cherry MX Brown RGB', 1),
(33, 17, 'img/monsgeek_m1w_barebone/1.jpg', 'Ảnh góc nghiêng MonsGeek M1W Barebone', 1),
(34, 17, 'img/monsgeek_m1w_barebone/2.jpg', 'Ảnh cận cảnh MonsGeek M1W Barebone', 1),
(35, 18, 'img/leobog_hi75_cnc_kit/1.jpg', 'Ảnh góc nghiêng Leobog Hi75 CNC Kit', 1),
(36, 18, 'img/leobog_hi75_cnc_kit/2.jpg', 'Ảnh cận cảnh Leobog Hi75 CNC Kit', 1),
(37, 19, 'img/tx_ap_foam_mod_pack/1.jpg', 'Ảnh góc nghiêng TX AP Foam Mod Pack', 1),
(38, 19, 'img/tx_ap_foam_mod_pack/2.jpg', 'Ảnh cận cảnh TX AP Foam Mod Pack', 1),
(39, 20, 'img/durock_v2_stabilizer_set/1.jpg', 'Ảnh góc nghiêng Durock V2 Stabilizer Set', 1),
(40, 20, 'img/durock_v2_stabilizer_set/2.jpg', 'Ảnh cận cảnh Durock V2 Stabilizer Set', 1),
(41, 21, 'img/krytox_205g0_lube_station_combo/1.jpg', 'Ảnh góc nghiêng Krytox 205g0 Lube Station Combo', 1),
(42, 21, 'img/krytox_205g0_lube_station_combo/2.jpg', 'Ảnh cận cảnh Krytox 205g0 Lube Station Combo', 1),
(43, 22, 'img/coiled_cable_black_white/1.jpg', 'Ảnh góc nghiêng Coiled Cable Black White', 1),
(44, 22, 'img/coiled_cable_black_white/2.jpg', 'Ảnh cận cảnh Coiled Cable Black White', 1),
(45, 23, 'img/walnut_wrist_rest_tkl/1.jpg', 'Ảnh góc nghiêng Walnut Wrist Rest TKL', 1),
(46, 23, 'img/walnut_wrist_rest_tkl/2.jpg', 'Ảnh cận cảnh Walnut Wrist Rest TKL', 1),
(47, 24, 'img/mod_starter_combo_75/1.jpg', 'Ảnh góc nghiêng Mod Starter Combo 75%', 1),
(48, 24, 'img/mod_starter_combo_75/2.jpg', 'Ảnh cận cảnh Mod Starter Combo 75%', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `idhoadon` int(11) NOT NULL,
  `idkhachhang` int(11) NOT NULL,
  `iddiachi` int(11) NOT NULL,
  `idnhanvien` int(11) DEFAULT NULL,
  `phuongthuctt` varchar(255) NOT NULL,
  `ngayxuat` date NOT NULL,
  `tongtien` decimal(10,2) NOT NULL,
  `trangthai` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hoadon`
--

INSERT INTO `hoadon` (`idhoadon`, `idkhachhang`, `iddiachi`, `idnhanvien`, `phuongthuctt`, `ngayxuat`, `tongtien`, `trangthai`) VALUES
(1, 8, 1, 1, 'chuyển khoản', '2025-04-09', 788888.00, 1),
(2, 5, 1, 1, 'chuyển khoản', '2025-04-09', 100000.00, 1),
(3, 3, 1, 1, 'ck', '2025-04-09', 99999999.99, 0),
(4, 1, 2, 5, 'Thanh toán khi nhận hàng', '2025-04-28', 220000.00, 0),
(5, 1, 2, 6, 'Thanh toán khi nhận hàng', '2025-04-28', 220000.00, 0),
(6, 1, 2, 7, 'Thanh toán khi nhận hàng', '2025-04-28', 470000.00, 0),
(7, 1, 2, 9, 'Thanh toán khi nhận hàng', '2025-04-28', 285000.00, 0),
(8, 1, 2, 10, 'Thanh toán khi nhận hàng', '2025-04-28', 220000.00, 0),
(9, 1, 2, 11, 'Thanh toán khi nhận hàng', '2025-04-28', 350000.00, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `idkhachhang` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sodienthoai` varchar(20) NOT NULL,
  `trangthai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`idkhachhang`, `ten`, `email`, `sodienthoai`, `trangthai`) VALUES
(1, 'Nguyễn Văn A', 'nguyenvana@gmail.com', '0912345678', 1),
(2, 'Trần Thị B', 'tranthib@gmail.com', '0987654321', 1),
(3, 'Lê Văn C', 'levanc@yahoo.com', '0909123456', 1),
(4, 'Phạm Thị D', 'phamthid@gmail.com', '0978123456', 1),
(5, 'Hoàng Văn E', 'hoangve@outlook.com', '0967890123', 1),
(6, 'Vũ Thị F', 'vuthif@gmail.com', '0912456789', 1),
(7, 'Đặng Văn G', 'dangvang@yahoo.com', '0988123456', 1),
(8, 'Bùi Thị H', 'buithih@gmail.com', '0909876543', 1),
(9, 'Mai Văn I', 'maivani@gmail.com', '0977123456', 1),
(10, 'Lý Thị K', 'lythik@outlook.com', '0966789012', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhacungcap`
--

CREATE TABLE `nhacungcap` (
  `idnhacungcap` int(11) NOT NULL,
  `tenncc` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sodienthoai` varchar(20) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `trangthai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhacungcap`
--

INSERT INTO `nhacungcap` (`idnhacungcap`, `tenncc`, `email`, `sodienthoai`, `diachi`, `trangthai`) VALUES
(1, 'Công ty TNHH MK Import', 'mkimport@gmail.com', '0911000001', 'Quận 1, TP.HCM', 1),
(2, 'Công ty Gear Source', 'gearsource@gmail.com', '0911000002', 'Tân Bình, TP.HCM', 1),
(3, 'Công ty Keycap Hub', 'keycaphub@gmail.com', '0911000003', 'Long Biên, Hà Nội', 1),
(4, 'Công ty Switch Craft', 'switchcraft@gmail.com', '0911000004', 'Nam Từ Liêm, Hà Nội', 1),
(5, 'Công ty Deskmat Việt', 'deskmatviet@gmail.com', '0911000005', 'Thủ Đức, TP.HCM', 1),
(6, 'Công ty Custom Tools', 'customtools@gmail.com', '0911000006', 'Hải Châu, Đà Nẵng', 1),
(7, 'Công ty Input Lab', 'inputlab@gmail.com', '0911000007', 'Quận 7, TP.HCM', 1),
(8, 'Công ty Keyboard Zone', 'keyboardzone@gmail.com', '0911000008', 'Ba Đình, Hà Nội', 1),
(9, 'Công ty RGB Works', 'rgbworks@gmail.com', '0911000009', 'Biên Hòa, Đồng Nai', 1),
(10, 'Công ty KeySense', 'keysense@gmail.com', '0911000010', 'Nha Trang, Khánh Hòa', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `idnhanvien` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `chucvu` varchar(255) NOT NULL,
  `sodienthoai` varchar(20) NOT NULL,
  `trangthai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`idnhanvien`, `ten`, `email`, `chucvu`, `sodienthoai`, `trangthai`) VALUES
(1, 'Nguyễn Văn A', 'nguyenvana@example.com', 'Nhân viên bán hàng', '0999888777', 1),
(2, 'Trần Thị B', 'tranthib@example.com', 'Nhân viên nhập hàng', '0123456789', 1),
(3, 'Lê Văn C', 'levanc@example.com', 'Quản lý', '0898787765', 1),
(4, 'Phạm Thị D', 'phamthid@example.com', 'Quản trị viên', '0898788788', 1),
(5, 'Thu Huyền', 'thuhuyen@gmail.com', 'Nhân viên bán hàng', '0123456781', 1),
(6, 'abc', 'abc@gmail.com', 'Nhân viên bán hàng', '0999777888', 1),
(7, 'Nguyen Van A', 'nguyenvana@example.com', 'Nhân viên bán hàng', '0901234001', 1),
(8, 'Tran Thi B', 'tranthib@example.com', 'Nhân viên bán hàng', '0901234002', 1),
(9, 'Le Van C', 'levanc@example.com', 'Nhân viên bán hàng', '0901234003', 1),
(10, 'Pham Thi D', 'phamthid@example.com', 'Nhân viên bán hàng', '0901234004', 1),
(11, 'Hoang Van E', 'hoangvane@example.com', 'Nhân viên bán hàng', '0901234005', 1),
(12, 'Nguyen Thi F', 'nguyenthif@example.com', 'Nhân viên bán hàng', '0901234006', 1),
(13, 'Tran Van G', 'tranvang@example.com', 'Nhân viên bán hàng', '0901234007', 1),
(14, 'Le Thi H', 'lethih@example.com', 'Nhân viên bán hàng', '0901234008', 1),
(15, 'Pham Van I', 'phamvani@example.com', 'Nhân viên bán hàng', '0901234009', 1),
(16, 'Hoang Thi K', 'hoangthik@example.com', 'Nhân viên bán hàng', '0901234010', 1),
(17, 'Nguyen Van L', 'nguyenvanl@example.com', 'Nhân viên bán hàng', '0901234011', 1),
(18, 'Tran Thi M', 'tranthim@example.com', 'Nhân viên bán hàng', '0901234012', 1),
(19, 'Le Van N', 'levann@example.com', 'Nhân viên bán hàng', '0901234013', 1),
(20, 'Pham Thi P', 'phamthip@example.com', 'Nhân viên bán hàng', '0901234014', 1),
(21, 'Hoang Van Q', 'hoangvanq@example.com', 'Nhân viên bán hàng', '0901234015', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhaphanphoi`
--

CREATE TABLE `nhaphanphoi` (
  `idnhaphaphoi` int(11) NOT NULL,
  `tennpp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sodienthoai` varchar(20) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `trangthai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhaphanphoi`
--

INSERT INTO `nhaphanphoi` (`idnhaphaphoi`, `tennpp`, `email`, `sodienthoai`, `diachi`, `trangthai`) VALUES
(1, 'DreamKey Distribution', 'sales@dreamkey.vn', '0909000001', 'Quận 3, TP.HCM', 1),
(2, 'MechaVN Supply', 'contact@mechavn.vn', '0909000002', 'Quận 10, TP.HCM', 1),
(3, 'Custom Corner', 'hello@customcorner.vn', '0909000003', 'Cầu Giấy, Hà Nội', 1),
(4, 'GearWorks Asia', 'asia@gearworks.vn', '0909000004', 'Hai Bà Trưng, Hà Nội', 1),
(5, 'SwitchHub', 'support@switchhub.vn', '0909000005', 'Thủ Đức, TP.HCM', 1),
(6, 'Keycap Studio', 'order@keycapstudio.vn', '0909000006', 'Bình Thạnh, TP.HCM', 1),
(7, 'DeskSetup Lab', 'desksetup@lab.vn', '0909000007', 'Hải Châu, Đà Nẵng', 1),
(8, 'Mod Kit Warehouse', 'warehouse@modkit.vn', '0909000008', 'Tân Bình, TP.HCM', 1),
(9, 'Esports Gear House', 'gear@esportshouse.vn', '0909000009', 'Nam Từ Liêm, Hà Nội', 1),
(10, 'Premium Input Co.', 'premium@input.vn', '0909000010', 'Ninh Kiều, Cần Thơ', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phanquyen`
--

CREATE TABLE `phanquyen` (
  `Quyen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Default' COMMENT 'Tên quyền',
  `QLCuaHang` int(1) NOT NULL DEFAULT 0,
  `QLSanPham` int(1) NOT NULL DEFAULT 0,
  `QLDanhMuc` int(1) NOT NULL DEFAULT 0,
  `QLNhanVien` int(1) NOT NULL DEFAULT 0,
  `QLKhachHang` int(1) NOT NULL DEFAULT 0,
  `QLNhaCungCap` int(1) NOT NULL DEFAULT 0,
  `QLDonHang` int(1) NOT NULL DEFAULT 0,
  `QLPhieuNhap` int(1) NOT NULL DEFAULT 0,
  `QLThongke` int(1) NOT NULL DEFAULT 0,
  `QLTaiKhoan` int(1) NOT NULL DEFAULT 0,
  `QLPhanQuyen` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phanquyen`
--

INSERT INTO `phanquyen` (`Quyen`, `QLCuaHang`, `QLSanPham`, `QLDanhMuc`, `QLNhanVien`, `QLKhachHang`, `QLNhaCungCap`, `QLDonHang`, `QLPhieuNhap`, `QLThongke`, `QLTaiKhoan`, `QLPhanQuyen`) VALUES
('Default', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('Nhân viên bán hàng', 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0),
('Nhân viên nhập hàng', 0, 1, 1, 0, 0, 1, 0, 1, 0, 0, 0),
('Quản lý', 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1),
('Quản trị viên', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieunhap`
--

CREATE TABLE `phieunhap` (
  `idphieunhap` int(11) NOT NULL,
  `idnhacungcap` int(11) NOT NULL,
  `idnhanvien` int(11) NOT NULL,
  `ngaynhap` date NOT NULL,
  `tongtien` decimal(10,2) NOT NULL,
  `trangthai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banphim`
--

CREATE TABLE `banphim` (
  `idbanphim` int(11) NOT NULL,
  `tenbanphim` varchar(255) NOT NULL,
  `idthuonghieu` int(11) NOT NULL,
  `idnhaphaphoi` int(11) NOT NULL,
  `idctdanhmuc` int(11) NOT NULL,
  `gia` decimal(10,2) NOT NULL,
  `sltonkho` int(11) NOT NULL,
  `mota` text NOT NULL,
  `anhbia` varchar(255) NOT NULL,
  `trangthai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `banphim`
--

INSERT INTO `banphim` (`idbanphim`, `tenbanphim`, `idthuonghieu`, `idnhaphaphoi`, `idctdanhmuc`, `gia`, `sltonkho`, `mota`, `anhbia`, `trangthai`) VALUES
(1, 'Akko 3098B Plus Black Gold', 1, 1, 1, 2290000.00, 32, 'Bàn phím cơ 98 phím wireless với plate ổn định, foam tiêu âm và keycap PBT. Phù hợp làm việc lẫn gaming, hỗ trợ kết nối 2.4G, Bluetooth và USB-C.
Thiết kế tối ưu cho nhu cầu thực tế, hoàn thiện chắc chắn và dễ phối với nhiều kiểu desk setup hiện đại.
Sản phẩm được chọn lọc để phù hợp cả người mới chơi lẫn người dùng đã có kinh nghiệm mod bàn phím.
Bảo hành đổi mới theo chính sách của UniKeys và hỗ trợ tư vấn build theo nhu cầu.
Hình ảnh minh họa được đồng bộ theo bộ nhận diện demo của dự án.', 'img/akko_3098b_plus_black_gold/bia.jpg', 1),
(2, 'Keychron V6 Max Knob', 2, 2, 1, 3190000.00, 18, 'Mẫu fullsize hot-swap có núm xoay, gasket mount và tương thích QMK/VIA. Thiết kế tối giản, build chắc, lý tưởng cho góc làm việc chuyên nghiệp.
Thiết kế tối ưu cho nhu cầu thực tế, hoàn thiện chắc chắn và dễ phối với nhiều kiểu desk setup hiện đại.
Sản phẩm được chọn lọc để phù hợp cả người mới chơi lẫn người dùng đã có kinh nghiệm mod bàn phím.
Bảo hành đổi mới theo chính sách của UniKeys và hỗ trợ tư vấn build theo nhu cầu.
Hình ảnh minh họa được đồng bộ theo bộ nhận diện demo của dự án.', 'img/keychron_v6_max_knob/bia.jpg', 1),
(3, 'Aula F99 Tri-Mode RGB', 3, 3, 1, 1890000.00, 26, 'Fullsize gọn gàng, hỗ trợ 3 chế độ kết nối và hệ thống LED RGB nổi bật. Âm gõ đầm, thích hợp cho người mới bắt đầu chơi bàn phím cơ.
Thiết kế tối ưu cho nhu cầu thực tế, hoàn thiện chắc chắn và dễ phối với nhiều kiểu desk setup hiện đại.
Sản phẩm được chọn lọc để phù hợp cả người mới chơi lẫn người dùng đã có kinh nghiệm mod bàn phím.
Bảo hành đổi mới theo chính sách của UniKeys và hỗ trợ tư vấn build theo nhu cầu.
Hình ảnh minh họa được đồng bộ theo bộ nhận diện demo của dự án.', 'img/aula_f99_tri_mode_rgb/bia.jpg', 1),
(4, 'MonsGeek M3 TKL Aluminum', 4, 4, 2, 3590000.00, 12, 'Bàn phím TKL khung nhôm CNC cứng cáp, cho trải nghiệm gõ chắc tay và cao cấp. Hot-swap 5 pin, dễ mod, hợp với setup làm việc tối giản.
Thiết kế tối ưu cho nhu cầu thực tế, hoàn thiện chắc chắn và dễ phối với nhiều kiểu desk setup hiện đại.
Sản phẩm được chọn lọc để phù hợp cả người mới chơi lẫn người dùng đã có kinh nghiệm mod bàn phím.
Bảo hành đổi mới theo chính sách của UniKeys và hỗ trợ tư vấn build theo nhu cầu.
Hình ảnh minh họa được đồng bộ theo bộ nhận diện demo của dự án.', 'img/monsgeek_m3_tkl_aluminum/bia.jpg', 1),
(5, 'Leobog K81 Pro TKL', 5, 5, 2, 2090000.00, 20, 'Layout TKL tối ưu cho game thủ cần không gian rê chuột rộng. Foam mod sẵn và switch ổn định giúp âm gõ gọn, ít tạp âm.
Thiết kế tối ưu cho nhu cầu thực tế, hoàn thiện chắc chắn và dễ phối với nhiều kiểu desk setup hiện đại.
Sản phẩm được chọn lọc để phù hợp cả người mới chơi lẫn người dùng đã có kinh nghiệm mod bàn phím.
Bảo hành đổi mới theo chính sách của UniKeys và hỗ trợ tư vấn build theo nhu cầu.
Hình ảnh minh họa được đồng bộ theo bộ nhận diện demo của dự án.', 'img/leobog_k81_pro_tkl/bia.jpg', 1),
(6, 'Akko 5075B Plus Joy of Life', 1, 1, 3, 2190000.00, 24, 'Layout 75 phần trăm nhỏ gọn, có màn hình mini và hỗ trợ tri-mode. Tông màu nổi bật, thích hợp cho setup cá tính và linh hoạt mang theo.
Thiết kế tối ưu cho nhu cầu thực tế, hoàn thiện chắc chắn và dễ phối với nhiều kiểu desk setup hiện đại.
Sản phẩm được chọn lọc để phù hợp cả người mới chơi lẫn người dùng đã có kinh nghiệm mod bàn phím.
Bảo hành đổi mới theo chính sách của UniKeys và hỗ trợ tư vấn build theo nhu cầu.
Hình ảnh minh họa được đồng bộ theo bộ nhận diện demo của dự án.', 'img/akko_5075b_plus_joy_of_life/bia.jpg', 1),
(7, 'Keychron V1 Max Carbon Black', 2, 2, 3, 2790000.00, 14, 'Bàn phím 75 phần trăm với núm xoay và firmware tùy biến mạnh. Khung máy chắc chắn, cảm giác gõ rõ ràng, tối ưu cho coder và content creator.
Thiết kế tối ưu cho nhu cầu thực tế, hoàn thiện chắc chắn và dễ phối với nhiều kiểu desk setup hiện đại.
Sản phẩm được chọn lọc để phù hợp cả người mới chơi lẫn người dùng đã có kinh nghiệm mod bàn phím.
Bảo hành đổi mới theo chính sách của UniKeys và hỗ trợ tư vấn build theo nhu cầu.
Hình ảnh minh họa được đồng bộ theo bộ nhận diện demo của dự án.', 'img/keychron_v1_max_carbon_black/bia.jpg', 1),
(8, 'GMK Botanical Clone PBT Set', 10, 6, 4, 990000.00, 40, 'Set keycap Cherry profile màu xanh lá lấy cảm hứng từ thiên nhiên. Chất liệu PBT dày, bề mặt nhám nhẹ và tương thích nhiều layout phổ biến.
Thiết kế tối ưu cho nhu cầu thực tế, hoàn thiện chắc chắn và dễ phối với nhiều kiểu desk setup hiện đại.
Sản phẩm được chọn lọc để phù hợp cả người mới chơi lẫn người dùng đã có kinh nghiệm mod bàn phím.
Bảo hành đổi mới theo chính sách của UniKeys và hỗ trợ tư vấn build theo nhu cầu.
Hình ảnh minh họa được đồng bộ theo bộ nhận diện demo của dự án.', 'img/gmk_botanical_clone_pbt_set/bia.jpg', 1),
(9, 'Studio PBT Olivia Noir', 10, 6, 5, 1150000.00, 22, 'Keycap OEM profile tone đen hồng sang trọng, legend sắc nét và độ hoàn thiện cao. Phù hợp với layout từ 65 phần trăm đến fullsize.
Thiết kế tối ưu cho nhu cầu thực tế, hoàn thiện chắc chắn và dễ phối với nhiều kiểu desk setup hiện đại.
Sản phẩm được chọn lọc để phù hợp cả người mới chơi lẫn người dùng đã có kinh nghiệm mod bàn phím.
Bảo hành đổi mới theo chính sách của UniKeys và hỗ trợ tư vấn build theo nhu cầu.
Hình ảnh minh họa được đồng bộ theo bộ nhận diện demo của dự án.', 'img/studio_pbt_olivia_noir/bia.jpg', 1),
(10, 'CustomLab Retro Beige Keycap', 11, 6, 5, 890000.00, 35, 'Set keycap mang phong cách retro beige cổ điển, hợp với setup văn phòng và workstation. Chất liệu PBT doubleshot cho độ bền sử dụng lâu dài.
Thiết kế tối ưu cho nhu cầu thực tế, hoàn thiện chắc chắn và dễ phối với nhiều kiểu desk setup hiện đại.
Sản phẩm được chọn lọc để phù hợp cả người mới chơi lẫn người dùng đã có kinh nghiệm mod bàn phím.
Bảo hành đổi mới theo chính sách của UniKeys và hỗ trợ tư vấn build theo nhu cầu.
Hình ảnh minh họa được đồng bộ theo bộ nhận diện demo của dự án.', 'img/customlab_retro_beige_keycap/bia.jpg', 1),
(11, 'Artisan Koi Escape Keycap', 11, 6, 6, 690000.00, 10, 'Artisan keycap resin thủ công với chủ đề cá koi, tạo điểm nhấn cho phím ESC. Phù hợp cho người thích cá nhân hóa bàn phím và sưu tầm artisan.
Thiết kế tối ưu cho nhu cầu thực tế, hoàn thiện chắc chắn và dễ phối với nhiều kiểu desk setup hiện đại.
Sản phẩm được chọn lọc để phù hợp cả người mới chơi lẫn người dùng đã có kinh nghiệm mod bàn phím.
Bảo hành đổi mới theo chính sách của UniKeys và hỗ trợ tư vấn build theo nhu cầu.
Hình ảnh minh họa được đồng bộ theo bộ nhận diện demo của dự án.', 'img/artisan_koi_escape_keycap/bia.jpg', 1),
(12, 'XDA Matcha Thick PBT Set', 10, 6, 4, 1090000.00, 16, 'Set keycap profile thấp đồng đều, mang màu matcha dịu mắt và âm gõ mềm. Phối đẹp với các kit nhôm hoặc setup tone trắng xanh.
Thiết kế tối ưu cho nhu cầu thực tế, hoàn thiện chắc chắn và dễ phối với nhiều kiểu desk setup hiện đại.
Sản phẩm được chọn lọc để phù hợp cả người mới chơi lẫn người dùng đã có kinh nghiệm mod bàn phím.
Bảo hành đổi mới theo chính sách của UniKeys và hỗ trợ tư vấn build theo nhu cầu.
Hình ảnh minh họa được đồng bộ theo bộ nhận diện demo của dự án.', 'img/xda_matcha_thick_pbt_set/bia.jpg', 1),
(13, 'Gateron Milky Yellow Pro', 6, 5, 7, 450000.00, 55, 'Switch linear quốc dân với lực nhấn vừa phải, hành trình mượt và âm trầm. Phù hợp cho người mới làm quen custom keyboard hoặc cần build giá tốt.
Thiết kế tối ưu cho nhu cầu thực tế, hoàn thiện chắc chắn và dễ phối với nhiều kiểu desk setup hiện đại.
Sản phẩm được chọn lọc để phù hợp cả người mới chơi lẫn người dùng đã có kinh nghiệm mod bàn phím.
Bảo hành đổi mới theo chính sách của UniKeys và hỗ trợ tư vấn build theo nhu cầu.
Hình ảnh minh họa được đồng bộ theo bộ nhận diện demo của dự án.', 'img/gateron_milky_yellow_pro/bia.jpg', 1),
(14, 'Akko Cream Blue V3', 1, 5, 8, 420000.00, 28, 'Switch tactile nổi bật với điểm khấc rõ ràng và phản hồi dứt khoát. Hợp cho người thích cảm giác gõ chắc tay khi làm việc và nhập liệu.
Thiết kế tối ưu cho nhu cầu thực tế, hoàn thiện chắc chắn và dễ phối với nhiều kiểu desk setup hiện đại.
Sản phẩm được chọn lọc để phù hợp cả người mới chơi lẫn người dùng đã có kinh nghiệm mod bàn phím.
Bảo hành đổi mới theo chính sách của UniKeys và hỗ trợ tư vấn build theo nhu cầu.
Hình ảnh minh họa được đồng bộ theo bộ nhận diện demo của dự án.', 'img/akko_cream_blue_v3/bia.jpg', 1),
(15, 'Kailh Box White', 7, 5, 9, 520000.00, 15, 'Switch clicky cho âm thanh nảy, rõ và vui tai. Cấu trúc BOX giúp tăng độ bền, phù hợp ai yêu thích phản hồi cơ học truyền thống.
Thiết kế tối ưu cho nhu cầu thực tế, hoàn thiện chắc chắn và dễ phối với nhiều kiểu desk setup hiện đại.
Sản phẩm được chọn lọc để phù hợp cả người mới chơi lẫn người dùng đã có kinh nghiệm mod bàn phím.
Bảo hành đổi mới theo chính sách của UniKeys và hỗ trợ tư vấn build theo nhu cầu.
Hình ảnh minh họa được đồng bộ theo bộ nhận diện demo của dự án.', 'img/kailh_box_white/bia.jpg', 1),
(16, 'Cherry MX Brown RGB', 8, 5, 8, 780000.00, 12, 'Dòng tactile kinh điển cho môi trường làm việc, cân bằng giữa gõ văn bản và giải trí. Độ ổn định cao và tương thích rộng với nhiều kit phổ thông.
Thiết kế tối ưu cho nhu cầu thực tế, hoàn thiện chắc chắn và dễ phối với nhiều kiểu desk setup hiện đại.
Sản phẩm được chọn lọc để phù hợp cả người mới chơi lẫn người dùng đã có kinh nghiệm mod bàn phím.
Bảo hành đổi mới theo chính sách của UniKeys và hỗ trợ tư vấn build theo nhu cầu.
Hình ảnh minh họa được đồng bộ theo bộ nhận diện demo của dự án.', 'img/cherry_mx_brown_rgb/bia.jpg', 1),
(17, 'MonsGeek M1W Barebone', 4, 4, 10, 2590000.00, 8, 'Barebone 75 phần trăm hỗ trợ hot-swap, gasket mount và wireless. Dễ phối switch, keycap và tinh chỉnh âm gõ theo phong cách cá nhân.
Thiết kế tối ưu cho nhu cầu thực tế, hoàn thiện chắc chắn và dễ phối với nhiều kiểu desk setup hiện đại.
Sản phẩm được chọn lọc để phù hợp cả người mới chơi lẫn người dùng đã có kinh nghiệm mod bàn phím.
Bảo hành đổi mới theo chính sách của UniKeys và hỗ trợ tư vấn build theo nhu cầu.
Hình ảnh minh họa được đồng bộ theo bộ nhận diện demo của dự án.', 'img/monsgeek_m1w_barebone/bia.jpg', 1),
(18, 'Leobog Hi75 CNC Kit', 5, 4, 11, 2890000.00, 6, 'Kit nhôm CNC 75 phần trăm có núm xoay, layout tối ưu và trọng lượng đầm tay. Rất phù hợp cho người thích âm gõ chắc và ngoại hình sang trọng.
Thiết kế tối ưu cho nhu cầu thực tế, hoàn thiện chắc chắn và dễ phối với nhiều kiểu desk setup hiện đại.
Sản phẩm được chọn lọc để phù hợp cả người mới chơi lẫn người dùng đã có kinh nghiệm mod bàn phím.
Bảo hành đổi mới theo chính sách của UniKeys và hỗ trợ tư vấn build theo nhu cầu.
Hình ảnh minh họa được đồng bộ theo bộ nhận diện demo của dự án.', 'img/leobog_hi75_cnc_kit/bia.jpg', 1),
(19, 'TX AP Foam Mod Pack', 11, 8, 13, 290000.00, 44, 'Bộ foam mod gồm case foam, plate foam và switch pad giúp giảm vang và làm âm gõ dày hơn. Dễ lắp cho nhiều kit phổ biến trên thị trường.
Thiết kế tối ưu cho nhu cầu thực tế, hoàn thiện chắc chắn và dễ phối với nhiều kiểu desk setup hiện đại.
Sản phẩm được chọn lọc để phù hợp cả người mới chơi lẫn người dùng đã có kinh nghiệm mod bàn phím.
Bảo hành đổi mới theo chính sách của UniKeys và hỗ trợ tư vấn build theo nhu cầu.
Hình ảnh minh họa được đồng bộ theo bộ nhận diện demo của dự án.', 'img/tx_ap_foam_mod_pack/bia.jpg', 1),
(20, 'Durock V2 Stabilizer Set', 9, 8, 14, 480000.00, 30, 'Bộ stabilizer screw-in nổi tiếng với độ ổn định cao, giảm rung lắc phím dài và dễ tinh chỉnh. Là món gần như bắt buộc cho build custom chỉn chu.
Thiết kế tối ưu cho nhu cầu thực tế, hoàn thiện chắc chắn và dễ phối với nhiều kiểu desk setup hiện đại.
Sản phẩm được chọn lọc để phù hợp cả người mới chơi lẫn người dùng đã có kinh nghiệm mod bàn phím.
Bảo hành đổi mới theo chính sách của UniKeys và hỗ trợ tư vấn build theo nhu cầu.
Hình ảnh minh họa được đồng bộ theo bộ nhận diện demo của dự án.', 'img/durock_v2_stabilizer_set/bia.jpg', 1),
(21, 'Krytox 205g0 Lube Station Combo', 11, 8, 15, 550000.00, 19, 'Combo lube switch gồm mỡ Krytox, brush và station mini, thích hợp cho người mới mod switch tại nhà. Giúp switch mượt hơn và âm gõ sạch hơn.
Thiết kế tối ưu cho nhu cầu thực tế, hoàn thiện chắc chắn và dễ phối với nhiều kiểu desk setup hiện đại.
Sản phẩm được chọn lọc để phù hợp cả người mới chơi lẫn người dùng đã có kinh nghiệm mod bàn phím.
Bảo hành đổi mới theo chính sách của UniKeys và hỗ trợ tư vấn build theo nhu cầu.
Hình ảnh minh họa được đồng bộ theo bộ nhận diện demo của dự án.', 'img/krytox_205g0_lube_station_combo/bia.jpg', 1),
(22, 'Coiled Cable Black White', 11, 7, 25, 650000.00, 14, 'Cáp cuộn USB-C với tone đen trắng hiện đại, phần coil dày đẹp và đầu aviator chắc chắn. Nâng tính thẩm mỹ cho bàn phím và bàn làm việc.
Thiết kế tối ưu cho nhu cầu thực tế, hoàn thiện chắc chắn và dễ phối với nhiều kiểu desk setup hiện đại.
Sản phẩm được chọn lọc để phù hợp cả người mới chơi lẫn người dùng đã có kinh nghiệm mod bàn phím.
Bảo hành đổi mới theo chính sách của UniKeys và hỗ trợ tư vấn build theo nhu cầu.
Hình ảnh minh họa được đồng bộ theo bộ nhận diện demo của dự án.', 'img/coiled_cable_black_white/bia.jpg', 1),
(23, 'Walnut Wrist Rest TKL', 11, 7, 26, 590000.00, 11, 'Kê tay gỗ óc chó cho layout TKL, hoàn thiện mịn và tông màu ấm áp. Tăng sự thoải mái khi gõ lâu và phối đẹp với setup premium.
Thiết kế tối ưu cho nhu cầu thực tế, hoàn thiện chắc chắn và dễ phối với nhiều kiểu desk setup hiện đại.
Sản phẩm được chọn lọc để phù hợp cả người mới chơi lẫn người dùng đã có kinh nghiệm mod bàn phím.
Bảo hành đổi mới theo chính sách của UniKeys và hỗ trợ tư vấn build theo nhu cầu.
Hình ảnh minh họa được đồng bộ theo bộ nhận diện demo của dự án.', 'img/walnut_wrist_rest_tkl/bia.jpg', 1),
(24, 'Mod Starter Combo 75%', 11, 10, 29, 3990000.00, 5, 'Combo dành cho người mới gồm barebone 75 phần trăm, switch linear, keycap PBT và phụ kiện mod cơ bản. Giải pháp trọn gói để bắt đầu chơi custom keyboard.
Thiết kế tối ưu cho nhu cầu thực tế, hoàn thiện chắc chắn và dễ phối với nhiều kiểu desk setup hiện đại.
Sản phẩm được chọn lọc để phù hợp cả người mới chơi lẫn người dùng đã có kinh nghiệm mod bàn phím.
Bảo hành đổi mới theo chính sách của UniKeys và hỗ trợ tư vấn build theo nhu cầu.
Hình ảnh minh họa được đồng bộ theo bộ nhận diện demo của dự án.', 'img/mod_starter_combo_75/bia.jpg', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thuonghieu`
--

CREATE TABLE `thuonghieu` (
  `idthuonghieu` int(11) NOT NULL,
  `tenthuonghieu` varchar(255) NOT NULL,
  `gioithieu` text NOT NULL,
  `trangthai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thuonghieu`
--

INSERT INTO `thuonghieu` (`idthuonghieu`, `tenthuonghieu`, `gioithieu`, `trangthai`) VALUES
(1, 'Akko', 'Thương hiệu nổi bật với các mẫu bàn phím cơ và keycap có thiết kế trẻ trung, hoàn thiện tốt và giá thành dễ tiếp cận.', 1),
(2, 'Keychron', 'Hãng bàn phím cơ nổi tiếng với layout đa dạng, hỗ trợ Mac/Windows và nhiều phiên bản wireless dành cho dân văn phòng lẫn coder.', 1),
(3, 'Aula', 'Thương hiệu gaming gear phổ biến, nổi bật với các mẫu bàn phím RGB và mức giá dễ mua cho người mới build setup.', 1),
(4, 'MonsGeek', 'Dòng sản phẩm nhôm CNC và barebone được cộng đồng custom keyboard ưa chuộng nhờ độ hoàn thiện tốt và âm gõ ổn định.', 1),
(5, 'Leobog', 'Thương hiệu tập trung vào kit nhôm, switch và phụ kiện mod, phù hợp cho người thích custom âm gõ sâu, thocky.', 1),
(6, 'Gateron', 'Nhà sản xuất switch hàng đầu với nhiều dòng linear, tactile và clicky, được dùng rộng rãi trong thị trường bàn phím cơ.', 1),
(7, 'Kailh', 'Thương hiệu switch lâu năm với nhiều dòng BOX và low-profile, nổi tiếng nhờ độ bền và cảm giác gõ rõ ràng.', 1),
(8, 'Cherry', 'Tên tuổi kinh điển của thế giới bàn phím cơ, nổi bật với các dòng MX Brown, Red, Blue và độ ổn định cao.', 1),
(9, 'Durock', 'Thương hiệu phụ kiện custom keyboard nổi bật với stabilizer, switch film và nhiều món mod được cộng đồng đánh giá cao.', 1),
(10, 'Studio PBT', 'Nhà phát triển set keycap PBT với màu sắc hiện đại, độ dày tốt và chất âm chắc tay, phù hợp nhiều layout.', 1),
(11, 'CustomLab', 'Thương hiệu chuyên combo mod, cáp cuộn và phụ kiện desk setup dành cho người chơi custom keyboard tại Việt Nam.', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan_khachhang`
--

CREATE TABLE `taikhoan_khachhang` (
  `idkhachhang` int(11) NOT NULL,
  `tendangnhap` varchar(50) NOT NULL,
  `matkhau` varchar(50) NOT NULL,
  `trangthai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan_khachhang`
--

INSERT INTO `taikhoan_khachhang` (`idkhachhang`, `tendangnhap`, `matkhau`, `trangthai`) VALUES
(1, 'nguyenvana', 'nguyenvana', 1),
(2, 'tranthib', 'tranthib', 1),
(3, 'levanc', 'levanc', 1),
(4, 'phamthid', 'phamthid', 1),
(5, 'hoangvane', 'hoangvane', 1),
(6, 'vuthif', 'vuthif', 1),
(7, 'dangvang', 'dangvang', 1),
(8, 'buithih', 'buithih', 1),
(9, 'maivani', 'maivani', 1),
(10, 'lythik', 'lythik', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan_nhanvien`
--

CREATE TABLE `taikhoan_nhanvien` (
  `idnhanvien` int(11) NOT NULL,
  `TaiKhoan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `MatKhau` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Quyen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `TrangThai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan_nhanvien`
--

INSERT INTO `taikhoan_nhanvien` (`idnhanvien`, `TaiKhoan`, `MatKhau`, `Quyen`, `TrangThai`) VALUES
(1, 'admin', 'admin', 'Quản trị viên', 1),
(2, 'nv01', 'nv01', 'Nhân viên nhập hàng', 1),
(3, 'quanly', 'quanly', 'Quản lý', 1),
(4, 'nv02', 'nv02', 'Nhân viên bán hàng', 1),
(5, 'thuhuyen', 'thuhuyen', 'Nhân viên bán hàng', 1),
(6, 'abcabc', '123456', 'Nhân viên bán hàng', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongtincuahang`
--

CREATE TABLE `thongtincuahang` (
  `idthongtin` int(11) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `sodienthoai` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `tiktok` varchar(255) DEFAULT NULL,
  `tenNH` varchar(255) NOT NULL,
  `stk` varchar(255) NOT NULL,
  `tenChuTK` varchar(255) NOT NULL,
  `anhQrCk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thongtincuahang`
--

INSERT INTO `thongtincuahang` (`idthongtin`, `diachi`, `sodienthoai`, `email`, `facebook`, `tiktok`, `tenNH`, `stk`, `tenChuTK`, `anhQrCk`) VALUES
(1, '92 Nguyễn Tri Phương, Quận 10, TP Hồ Chí Minh', '0909 123 789', 'support@unikeys.vn', 'https://www.facebook.com/', 'https://tiktok.com/', 'Vietcombank', '1029384756', 'UniKeys', '/resources/images/QrCode.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongtinnhanhang`
--

CREATE TABLE `thongtinnhanhang` (
  `iddiachi` int(11) NOT NULL,
  `idkhachhang` int(11) NOT NULL,
  `thanhpho` varchar(255) NOT NULL,
  `huyen` varchar(255) NOT NULL,
  `xa` varchar(255) NOT NULL,
  `diachi_chitiet` varchar(255) NOT NULL,
  `hotenNgNhan` varchar(255) NOT NULL,
  `sdtNgNhan` varchar(20) NOT NULL,
  `emailNgNhan` varchar(50) DEFAULT NULL,
  `trangthai` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thongtinnhanhang`
--

INSERT INTO `thongtinnhanhang` (`iddiachi`, `idkhachhang`, `thanhpho`, `huyen`, `xa`, `diachi_chitiet`, `hotenNgNhan`, `sdtNgNhan`, `emailNgNhan`, `trangthai`) VALUES
(1, 8, 'tphcm', 'abc', 'abc', 'abc', 'abc', '0999888999', 'abc@gmail.com', 0),
(2, 1, 'Hồ Chí Minh', 'Quận 1', 'Phường Bến Nghé', 'ssdsdá', 'ádf', '0123456789', '', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`idbanner`);

--
-- Chỉ mục cho bảng `chitietdanhmuc`
--
ALTER TABLE `chitietdanhmuc`
  ADD PRIMARY KEY (`idchitietdanhmuc`),
  ADD KEY `fk_iddanhmuc` (`iddanhmuc`);

--
-- Chỉ mục cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD PRIMARY KEY (`idchitiethoadon`),
  ADD KEY `fk_idhoadon` (`idhoadon`),
  ADD KEY `fk_idbanphim` (`idbanphim`);

--
-- Chỉ mục cho bảng `chitietphieunhap`
--
ALTER TABLE `chitietphieunhap`
  ADD PRIMARY KEY (`idphieunhap`,`idbanphim`),
  ADD KEY `fk_sach_ctpn` (`idbanphim`),
  ADD KEY `fk_phieunhap_ctpn` (`idphieunhap`);

--
-- Chỉ mục cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`iddanhmuc`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`idgiohang`),
  ADD KEY `fk_idkhachhang3` (`idkhachhang`),
  ADD KEY `fk_idbanphim5` (`idbanphim`);

--
-- Chỉ mục cho bảng `hinhanhsach`
--
ALTER TABLE `hinhanhsach`
  ADD PRIMARY KEY (`idhinhanh`),
  ADD KEY `fk_idbanphim2` (`idbanphim`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`idhoadon`),
  ADD KEY `fk_idkhachhang` (`idkhachhang`),
  ADD KEY `fk_idnhanvien` (`idnhanvien`),
  ADD KEY `fk_iddiachi` (`iddiachi`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`idkhachhang`);

--
-- Chỉ mục cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  ADD PRIMARY KEY (`idnhacungcap`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`idnhanvien`),
  ADD KEY `fk_chucvu_nhanvien` (`chucvu`);

--
-- Chỉ mục cho bảng `nhaphanphoi`
--
ALTER TABLE `nhaphanphoi`
  ADD PRIMARY KEY (`idnhaphaphoi`);

--
-- Chỉ mục cho bảng `phanquyen`
--
ALTER TABLE `phanquyen`
  ADD PRIMARY KEY (`Quyen`);

--
-- Chỉ mục cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD PRIMARY KEY (`idphieunhap`),
  ADD KEY `fk_idnhacungcap` (`idnhacungcap`),
  ADD KEY `fk_idnhanvien1` (`idnhanvien`);

--
-- Chỉ mục cho bảng `banphim`
--
ALTER TABLE `banphim`
  ADD PRIMARY KEY (`idbanphim`),
  ADD KEY `fk_idnhaphaphoi` (`idnhaphaphoi`),
  ADD KEY `fk_idthuonghieu` (`idthuonghieu`),
  ADD KEY `fk_iddanhmuc1` (`idctdanhmuc`);

--
-- Chỉ mục cho bảng `thuonghieu`
--
ALTER TABLE `thuonghieu`
  ADD PRIMARY KEY (`idthuonghieu`);

--
-- Chỉ mục cho bảng `taikhoan_khachhang`
--
ALTER TABLE `taikhoan_khachhang`
  ADD PRIMARY KEY (`idkhachhang`);

--
-- Chỉ mục cho bảng `taikhoan_nhanvien`
--
ALTER TABLE `taikhoan_nhanvien`
  ADD PRIMARY KEY (`idnhanvien`),
  ADD KEY `fk_quyen` (`Quyen`);

--
-- Chỉ mục cho bảng `thongtincuahang`
--
ALTER TABLE `thongtincuahang`
  ADD PRIMARY KEY (`idthongtin`);

--
-- Chỉ mục cho bảng `thongtinnhanhang`
--
ALTER TABLE `thongtinnhanhang`
  ADD PRIMARY KEY (`iddiachi`),
  ADD KEY `fk_khachhang_nhanhang` (`idkhachhang`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `banner`
--
ALTER TABLE `banner`
  MODIFY `idbanner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `chitietdanhmuc`
--
ALTER TABLE `chitietdanhmuc`
  MODIFY `idchitietdanhmuc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  MODIFY `idchitiethoadon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `iddanhmuc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `idgiohang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `hinhanhsach`
--
ALTER TABLE `hinhanhsach`
  MODIFY `idhinhanh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;

--
-- AUTO_INCREMENT cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `idhoadon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `idkhachhang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  MODIFY `idnhacungcap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `idnhanvien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `nhaphanphoi`
--
ALTER TABLE `nhaphanphoi`
  MODIFY `idnhaphaphoi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  MODIFY `idphieunhap` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `banphim`
--
ALTER TABLE `banphim`
  MODIFY `idbanphim` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT cho bảng `thuonghieu`
--
ALTER TABLE `thuonghieu`
  MODIFY `idthuonghieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `taikhoan_khachhang`
--
ALTER TABLE `taikhoan_khachhang`
  MODIFY `idkhachhang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `taikhoan_nhanvien`
--
ALTER TABLE `taikhoan_nhanvien`
  MODIFY `idnhanvien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `thongtincuahang`
--
ALTER TABLE `thongtincuahang`
  MODIFY `idthongtin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `thongtinnhanhang`
--
ALTER TABLE `thongtinnhanhang`
  MODIFY `iddiachi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietdanhmuc`
--
ALTER TABLE `chitietdanhmuc`
  ADD CONSTRAINT `fk_iddanhmuc` FOREIGN KEY (`iddanhmuc`) REFERENCES `danhmuc` (`iddanhmuc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD CONSTRAINT `fk_idhoadon` FOREIGN KEY (`idhoadon`) REFERENCES `hoadon` (`idhoadon`),
  ADD CONSTRAINT `fk_idbanphim` FOREIGN KEY (`idbanphim`) REFERENCES `banphim` (`idbanphim`);

--
-- Các ràng buộc cho bảng `chitietphieunhap`
--
ALTER TABLE `chitietphieunhap`
  ADD CONSTRAINT `fk_phieunhap_ctpn` FOREIGN KEY (`idphieunhap`) REFERENCES `phieunhap` (`idphieunhap`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sach_ctpn` FOREIGN KEY (`idbanphim`) REFERENCES `banphim` (`idbanphim`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `fk_idkhachhang3` FOREIGN KEY (`idkhachhang`) REFERENCES `khachhang` (`idkhachhang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idbanphim5` FOREIGN KEY (`idbanphim`) REFERENCES `banphim` (`idbanphim`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `hinhanhsach`
--
ALTER TABLE `hinhanhsach`
  ADD CONSTRAINT `fk_idbanphim2` FOREIGN KEY (`idbanphim`) REFERENCES `banphim` (`idbanphim`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `fk_iddiachi` FOREIGN KEY (`iddiachi`) REFERENCES `thongtinnhanhang` (`iddiachi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idkhachhang` FOREIGN KEY (`idkhachhang`) REFERENCES `khachhang` (`idkhachhang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idnhanvien` FOREIGN KEY (`idnhanvien`) REFERENCES `nhanvien` (`idnhanvien`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `fk_chucvu_nhanvien` FOREIGN KEY (`chucvu`) REFERENCES `phanquyen` (`Quyen`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD CONSTRAINT `fk_idnhacungcap` FOREIGN KEY (`idnhacungcap`) REFERENCES `nhacungcap` (`idnhacungcap`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idnhanvien1` FOREIGN KEY (`idnhanvien`) REFERENCES `nhanvien` (`idnhanvien`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `banphim`
--
ALTER TABLE `banphim`
  ADD CONSTRAINT `fk_iddanhmuc1` FOREIGN KEY (`idctdanhmuc`) REFERENCES `chitietdanhmuc` (`idchitietdanhmuc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idnhaphaphoi` FOREIGN KEY (`idnhaphaphoi`) REFERENCES `nhaphanphoi` (`idnhaphaphoi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idthuonghieu` FOREIGN KEY (`idthuonghieu`) REFERENCES `thuonghieu` (`idthuonghieu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `taikhoan_khachhang`
--
ALTER TABLE `taikhoan_khachhang`
  ADD CONSTRAINT `fk_taikhoan_khachhang` FOREIGN KEY (`idkhachhang`) REFERENCES `khachhang` (`idkhachhang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `taikhoan_nhanvien`
--
ALTER TABLE `taikhoan_nhanvien`
  ADD CONSTRAINT `fk_nhanvien` FOREIGN KEY (`idnhanvien`) REFERENCES `nhanvien` (`idnhanvien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_quyen` FOREIGN KEY (`Quyen`) REFERENCES `phanquyen` (`Quyen`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `thongtinnhanhang`
--
ALTER TABLE `thongtinnhanhang`
  ADD CONSTRAINT `fk_khachhang_nhanhang` FOREIGN KEY (`idkhachhang`) REFERENCES `khachhang` (`idkhachhang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
