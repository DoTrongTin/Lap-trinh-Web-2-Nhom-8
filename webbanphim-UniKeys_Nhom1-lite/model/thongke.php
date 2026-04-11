<?php
// ================================================================
// MODEL: thongke.php (thay thế file cũ)
// Đặt tại: webbanphim-UniKeys_Nhom1-lite/model/thongke.php
// ================================================================

/**
 * 1. Tra cứu số lượng tồn kho của sản phẩm tại thời điểm hiện tại
 *    (Tìm theo tên hoặc ID sản phẩm)
 */
function getTonKhoSanPham($keyword = '') {
    $conn = connectdb();
    if (!$conn) return [];

    try {
        $sql = "SELECT b.idbanphim, b.tenbanphim, b.sltonkho, b.gia, b.trangthai,
                       th.tenthuonghieu, dm.tendanhmuc, ctdm.tenchitietdanhmuc
                FROM banphim b
                JOIN thuonghieu th ON b.idthuonghieu = th.idthuonghieu
                JOIN chitietdanhmuc ctdm ON b.idctdanhmuc = ctdm.idchitietdanhmuc
                JOIN danhmuc dm ON ctdm.iddanhmuc = dm.iddanhmuc
                WHERE b.tenbanphim LIKE :keyword OR b.idbanphim LIKE :keyword
                ORDER BY b.sltonkho ASC";

        $stmt = $conn->prepare($sql);
        $kw = '%' . $keyword . '%';
        $stmt->bindValue(':keyword', $kw);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Lỗi tra cứu tồn kho: " . $e->getMessage());
        return [];
    }
}

/**
 * 2. Báo cáo tổng số lượng nhập – xuất của từng sản phẩm
 *    trong khoảng thời gian xác định
 */
function getBaoCaoNhapXuat($startDate, $endDate) {
    $conn = connectdb();
    if (!$conn) return [];

    try {
        // Tổng nhập trong khoảng thời gian
        $sqlNhap = "SELECT ct.idbanphim, b.tenbanphim,
                           COALESCE(SUM(ct.soluong), 0) AS tong_nhap,
                           COALESCE(SUM(ct.soluong * ct.dongia), 0) AS tong_tien_nhap
                    FROM chitietphieunhap ct
                    JOIN phieunhap pn ON ct.idphieunhap = pn.idphieunhap
                    JOIN banphim b ON ct.idbanphim = b.idbanphim
                    WHERE pn.ngaynhap BETWEEN :start AND :end
                      AND pn.trangthai = 1
                    GROUP BY ct.idbanphim, b.tenbanphim";

        // Tổng xuất (từ hóa đơn đã xác nhận hoặc đã giao) trong khoảng thời gian
        $sqlXuat = "SELECT cthd.idbanphim,
                           COALESCE(SUM(cthd.soluong), 0) AS tong_xuat,
                           COALESCE(SUM(cthd.soluong * cthd.dongia), 0) AS tong_tien_xuat
                    FROM chitiethoadon cthd
                    JOIN hoadon hd ON cthd.idhoadon = hd.idhoadon
                    WHERE hd.ngayxuat BETWEEN :start AND :end
                      AND hd.trangthai IN (1, 2)
                    GROUP BY cthd.idbanphim";

        $stmtNhap = $conn->prepare($sqlNhap);
        $stmtNhap->bindValue(':start', $startDate);
        $stmtNhap->bindValue(':end', $endDate);
        $stmtNhap->execute();
        $dataNhap = $stmtNhap->fetchAll(PDO::FETCH_ASSOC);

        $stmtXuat = $conn->prepare($sqlXuat);
        $stmtXuat->bindValue(':start', $startDate);
        $stmtXuat->bindValue(':end', $endDate);
        $stmtXuat->execute();
        $dataXuat = $stmtXuat->fetchAll(PDO::FETCH_ASSOC);

        // Gộp nhập và xuất theo idbanphim
        $result = [];
        foreach ($dataNhap as $row) {
            $id = $row['idbanphim'];
            $result[$id] = [
                'idbanphim'      => $id,
                'tenbanphim'     => $row['tenbanphim'],
                'tong_nhap'      => (int)$row['tong_nhap'],
                'tong_tien_nhap' => (float)$row['tong_tien_nhap'],
                'tong_xuat'      => 0,
                'tong_tien_xuat' => 0,
            ];
        }
        foreach ($dataXuat as $row) {
            $id = $row['idbanphim'];
            if (!isset($result[$id])) {
                // Lấy tên sản phẩm nếu chưa có trong nhập
                $stmtName = $conn->prepare("SELECT tenbanphim FROM banphim WHERE idbanphim = :id");
                $stmtName->bindValue(':id', $id, PDO::PARAM_INT);
                $stmtName->execute();
                $name = $stmtName->fetchColumn();
                $result[$id] = [
                    'idbanphim'      => $id,
                    'tenbanphim'     => $name,
                    'tong_nhap'      => 0,
                    'tong_tien_nhap' => 0,
                    'tong_xuat'      => 0,
                    'tong_tien_xuat' => 0,
                ];
            }
            $result[$id]['tong_xuat']      = (int)$row['tong_xuat'];
            $result[$id]['tong_tien_xuat'] = (float)$row['tong_tien_xuat'];
        }

        // Sắp xếp theo tên sản phẩm
        usort($result, fn($a, $b) => strcmp($a['tenbanphim'], $b['tenbanphim']));
        return array_values($result);

    } catch (PDOException $e) {
        error_log("Lỗi báo cáo nhập xuất: " . $e->getMessage());
        return [];
    }
}

/**
 * 3. Cảnh báo sản phẩm sắp hết hàng
 *    Lấy danh sách sản phẩm có tồn kho <= $nguong
 */
function getCanhBaoHetHang($nguong = 10) {
    $conn = connectdb();
    if (!$conn) return [];

    try {
        $sql = "SELECT b.idbanphim, b.tenbanphim, b.sltonkho, b.gia, b.trangthai,
                       th.tenthuonghieu, dm.tendanhmuc
                FROM banphim b
                JOIN thuonghieu th ON b.idthuonghieu = th.idthuonghieu
                JOIN chitietdanhmuc ctdm ON b.idctdanhmuc = ctdm.idchitietdanhmuc
                JOIN danhmuc dm ON ctdm.iddanhmuc = dm.iddanhmuc
                WHERE b.sltonkho <= :nguong
                ORDER BY b.sltonkho ASC";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':nguong', (int)$nguong, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Lỗi cảnh báo hết hàng: " . $e->getMessage());
        return [];
    }
}

/**
 * Giữ lại hàm cũ (top khách hàng) để không mất chức năng cũ
 */
function getStatistics($start_date, $end_date, $top_kh = null, $sort_order = 'DESC') {
    $conn = connectdb();
    if (!$conn) {
        return ['status' => 'error', 'message' => 'Lỗi kết nối database'];
    }
    try {
        $order = strtoupper($sort_order) === 'ASC' ? 'ASC' : 'DESC';
        $sql = "SELECT khachhang.ten,
                    GROUP_CONCAT(hoadon.idhoadon ORDER BY hoadon.idhoadon) AS ds_don_hang,
                    SUM(hoadon.tongtien) AS tong_mua,
                    hoadon.idkhachhang
                FROM hoadon
                JOIN khachhang ON hoadon.idkhachhang = khachhang.idkhachhang
                WHERE hoadon.ngayxuat BETWEEN :start_date AND :end_date
                  AND hoadon.trangthai IN (1, 2)
                GROUP BY hoadon.idkhachhang, khachhang.ten
                ORDER BY tong_mua $order";
        if ($top_kh !== null) {
            $sql .= " LIMIT " . intval($top_kh);
        }
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':end_date', $end_date);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dsKhachHang = [];
        foreach ($result as $row) {
            $ma_kh = $row['idkhachhang'];
            if (!isset($dsKhachHang[$ma_kh])) {
                $dsKhachHang[$ma_kh] = [
                    'ten'          => $row['ten'],
                    'tong_mua'     => 0,
                    'ds_don_hang'  => []
                ];
            }
            $dsKhachHang[$ma_kh]['tong_mua'] += $row['tong_mua'];
            $dsKhachHang[$ma_kh]['ds_don_hang'] = explode(",", $row['ds_don_hang']);
        }
        return ['status' => 'success', 'data' => array_values($dsKhachHang)];
    } catch (PDOException $e) {
        return ['status' => 'error', 'message' => $e->getMessage()];
    }
}