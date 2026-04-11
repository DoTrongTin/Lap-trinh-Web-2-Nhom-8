<?php
// ================================================================
// CONTROLLER: pagThongKe.php (thay thế file cũ)
// Đặt tại: webbanphim-UniKeys_Nhom1-lite/admin/controller/pagThongKe.php
// ================================================================

require_once '../../model/connectDB.php';
require_once '../../model/thongke.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Phương thức không hợp lệ']);
    exit;
}

$action = $_POST['action'] ?? '';

switch ($action) {

    // -----------------------------------------------------------
    // 1. Tra cứu tồn kho
    // -----------------------------------------------------------
    case 'ton_kho':
        $keyword = trim($_POST['keyword'] ?? '');
        $data    = getTonKhoSanPham($keyword);
        echo json_encode(['status' => 'success', 'data' => $data]);
        break;

    // -----------------------------------------------------------
    // 2. Báo cáo nhập – xuất
    // -----------------------------------------------------------
    case 'nhap_xuat':
        $startDate = $_POST['start_date'] ?? '';
        $endDate   = $_POST['end_date']   ?? '';
        if (empty($startDate) || empty($endDate)) {
            echo json_encode(['status' => 'error', 'message' => 'Vui lòng chọn khoảng thời gian']);
            exit;
        }
        if ($startDate > $endDate) {
            echo json_encode(['status' => 'error', 'message' => 'Ngày bắt đầu phải nhỏ hơn ngày kết thúc']);
            exit;
        }
        $data = getBaoCaoNhapXuat($startDate, $endDate);
        echo json_encode(['status' => 'success', 'data' => $data]);
        break;

    // -----------------------------------------------------------
    // 3. Cảnh báo sắp hết hàng
    // -----------------------------------------------------------
    case 'canh_bao':
        $nguong = isset($_POST['nguong']) && is_numeric($_POST['nguong'])
                  ? max(0, (int)$_POST['nguong'])
                  : 10;
        $data = getCanhBaoHetHang($nguong);
        echo json_encode(['status' => 'success', 'data' => $data, 'nguong' => $nguong]);
        break;

    // -----------------------------------------------------------
    // 4. Thống kê khách hàng (giữ lại từ phiên bản cũ)
    // -----------------------------------------------------------
    case 'khach_hang':
        $startDate  = $_POST['start_date']  ?? '';
        $endDate    = $_POST['end_date']    ?? '';
        $topKh      = isset($_POST['top_kh']) && is_numeric($_POST['top_kh'])
                      ? (int)$_POST['top_kh'] : null;
        $sortOrder  = in_array(strtoupper($_POST['sort_order'] ?? ''), ['ASC', 'DESC'])
                      ? strtoupper($_POST['sort_order']) : 'DESC';
        if (empty($startDate) || empty($endDate)) {
            echo json_encode(['status' => 'error', 'message' => 'Vui lòng chọn khoảng thời gian']);
            exit;
        }
        $result = getStatistics($startDate, $endDate, $topKh, $sortOrder);
        echo json_encode($result);
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Action không hợp lệ']);
}