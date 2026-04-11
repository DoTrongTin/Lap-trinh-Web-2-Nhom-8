<!-- ================================================================
     VIEW: thongke.php (thay thế file cũ)
     Đặt tại: webbanphim-UniKeys_Nhom1-lite/admin/view/thongke.php
     Gồm 4 tab:
       1. Tra cứu tồn kho
       2. Báo cáo nhập – xuất
       3. Cảnh báo sắp hết hàng
       4. Thống kê khách hàng (giữ lại)
     ================================================================ -->

<?php
    include_once '../../model/connectDB.php';
    include_once '../../model/hoadon.php';
    $maxKhachHang = getSoLuongKhachMuaHang();
?>

<link rel="stylesheet" href="../view/layout/css/thongke.css">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
/* ---- Tabs ---- */
.tk-tabs {
    display: flex;
    gap: 6px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}
.tk-tab-btn {
    padding: 9px 20px;
    border: 2px solid #2980b9;
    border-radius: 6px;
    background: #fff;
    color: #2980b9;
    font-weight: 600;
    cursor: pointer;
    transition: .2s;
    font-size: 14px;
}
.tk-tab-btn.active, .tk-tab-btn:hover {
    background: #2980b9;
    color: #fff;
}
.tk-panel { display: none; }
.tk-panel.active { display: block; }

/* ---- Card ---- */
.tk-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,.08);
    padding: 24px;
    margin-bottom: 24px;
}
.tk-card h4 {
    color: #2980b9;
    font-weight: 700;
    margin-bottom: 16px;
    border-left: 4px solid #2980b9;
    padding-left: 10px;
}

/* ---- Form inline ---- */
.tk-form-row {
    display: flex;
    gap: 12px;
    align-items: flex-end;
    flex-wrap: wrap;
    margin-bottom: 16px;
}
.tk-form-group {
    display: flex;
    flex-direction: column;
    gap: 4px;
}
.tk-form-group label {
    font-size: 13px;
    font-weight: 600;
    color: #555;
}
.tk-form-group input, .tk-form-group select {
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
    min-width: 160px;
}
.tk-btn {
    padding: 9px 20px;
    background: #2980b9;
    color: #fff;
    border: none;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    font-size: 14px;
    transition: .2s;
    align-self: flex-end;
}
.tk-btn:hover { opacity: .85; }
.tk-btn-export {
    background: #27ae60;
}

/* ---- Table ---- */
.tk-table-wrap {
    overflow-x: auto;
    max-height: 420px;
    overflow-y: auto;
}
.tk-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}
.tk-table thead th {
    background: #2980b9;
    color: #fff;
    padding: 10px 12px;
    text-align: center;
    position: sticky;
    top: 0;
    z-index: 2;
    white-space: nowrap;
}
.tk-table tbody td {
    padding: 9px 12px;
    border-bottom: 1px solid #eee;
    text-align: center;
    vertical-align: middle;
}
.tk-table tbody tr:hover { background: #f0f7ff; }

/* ---- Badges ---- */
.badge-danger { background: #e74c3c; color:#fff; padding: 3px 10px; border-radius: 12px; font-size:12px; }
.badge-warning { background: #f39c12; color:#fff; padding: 3px 10px; border-radius: 12px; font-size:12px; }
.badge-success { background: #27ae60; color:#fff; padding: 3px 10px; border-radius: 12px; font-size:12px; }

/* ---- Summary boxes ---- */
.tk-summary {
    display: flex;
    gap: 14px;
    flex-wrap: wrap;
    margin-bottom: 16px;
}
.tk-summary-box {
    flex: 1;
    min-width: 160px;
    padding: 14px 18px;
    border-radius: 8px;
    text-align: center;
    color: #fff;
}
.tk-summary-box .num { font-size: 26px; font-weight: 700; }
.tk-summary-box .lbl { font-size: 12px; margin-top: 4px; opacity: .9; }
.box-blue { background: #2980b9; }
.box-green { background: #27ae60; }
.box-red { background: #e74c3c; }
.box-orange { background: #f39c12; }

/* ---- Empty state ---- */
.tk-empty {
    text-align: center;
    padding: 40px;
    color: #aaa;
    font-size: 15px;
}

/* ---- Loading ---- */
.tk-loading {
    text-align: center;
    padding: 30px;
    color: #2980b9;
}

@media(max-width:768px){
    .tk-form-row { flex-direction:column; }
    .tk-form-group input, .tk-form-group select { min-width: 100%; }
    .tk-summary-box { min-width: calc(50% - 7px); }
}
</style>

<div class="right-content">
    <!-- ======== TAB BUTTONS ======== -->
    <div class="tk-tabs">
        <button class="tk-tab-btn active" onclick="switchTab('tab-tonkho', this)">📦 Tra cứu tồn kho</button>
        <button class="tk-tab-btn" onclick="switchTab('tab-nhapxuat', this)">📊 Báo cáo nhập – xuất</button>
        <button class="tk-tab-btn" onclick="switchTab('tab-canhbao', this)">⚠️ Cảnh báo sắp hết hàng</button>
        <button class="tk-tab-btn" onclick="switchTab('tab-khachhang', this)">👥 Thống kê khách hàng</button>
    </div>

    <!-- ======================================================
         TAB 1: TRA CỨU TỒN KHO
         ====================================================== -->
    <div id="tab-tonkho" class="tk-panel active">
        <div class="tk-card">
            <h4>📦 Tra cứu số lượng tồn kho</h4>
            <div class="tk-form-row">
                <div class="tk-form-group">
                    <label>Tên / ID sản phẩm</label>
                    <input type="text" id="tk-keyword" placeholder="Nhập tên hoặc mã sản phẩm..."
                           oninput="debounceTonKho()">
                </div>
                <button class="tk-btn" onclick="loadTonKho()">🔍 Tra cứu</button>
                <button class="tk-btn" onclick="loadTonKho('')" style="background:#6c757d">📋 Hiển thị tất cả</button>
            </div>

            <!-- Summary -->
            <div class="tk-summary" id="tk-summary" style="display:none">
                <div class="tk-summary-box box-blue">
                    <div class="num" id="sum-total">0</div>
                    <div class="lbl">Tổng sản phẩm</div>
                </div>
                <div class="tk-summary-box box-green">
                    <div class="num" id="sum-ok">0</div>
                    <div class="lbl">Còn hàng tốt (&gt;10)</div>
                </div>
                <div class="tk-summary-box box-orange">
                    <div class="num" id="sum-low">0</div>
                    <div class="lbl">Sắp hết (≤10)</div>
                </div>
                <div class="tk-summary-box box-red">
                    <div class="num" id="sum-out">0</div>
                    <div class="lbl">Hết hàng (= 0)</div>
                </div>
            </div>

            <div id="tonkho-result">
                <div class="tk-empty">Nhập từ khóa hoặc nhấn "Hiển thị tất cả" để xem tồn kho</div>
            </div>
        </div>
    </div>

    <!-- ======================================================
         TAB 2: BÁO CÁO NHẬP – XUẤT
         ====================================================== -->
    <div id="tab-nhapxuat" class="tk-panel">
        <div class="tk-card">
            <h4>📊 Báo cáo tổng số lượng nhập – xuất theo thời gian</h4>
            <div class="tk-form-row">
                <div class="tk-form-group">
                    <label>Từ ngày</label>
                    <input type="date" id="nx-start">
                </div>
                <div class="tk-form-group">
                    <label>Đến ngày</label>
                    <input type="date" id="nx-end">
                </div>
                <button class="tk-btn" onclick="loadNhapXuat()">📊 Xem báo cáo</button>
            </div>

            <!-- Summary -->
            <div class="tk-summary" id="nx-summary" style="display:none">
                <div class="tk-summary-box box-green">
                    <div class="num" id="nx-sum-nhap">0</div>
                    <div class="lbl">Tổng SL nhập</div>
                </div>
                <div class="tk-summary-box box-red">
                    <div class="num" id="nx-sum-xuat">0</div>
                    <div class="lbl">Tổng SL xuất</div>
                </div>
                <div class="tk-summary-box box-blue">
                    <div class="num" id="nx-sum-tiennhap">0đ</div>
                    <div class="lbl">Tổng tiền nhập</div>
                </div>
                <div class="tk-summary-box box-orange">
                    <div class="num" id="nx-sum-tienxuat">0đ</div>
                    <div class="lbl">Tổng tiền xuất</div>
                </div>
            </div>

            <div id="nhapxuat-result">
                <div class="tk-empty">Chọn khoảng thời gian và nhấn "Xem báo cáo"</div>
            </div>
        </div>
    </div>

    <!-- ======================================================
         TAB 3: CẢNH BÁO SẮP HẾT HÀNG
         ====================================================== -->
    <div id="tab-canhbao" class="tk-panel">
        <div class="tk-card">
            <h4>⚠️ Cảnh báo sản phẩm sắp hết hàng</h4>
            <div class="tk-form-row">
                <div class="tk-form-group">
                    <label>Ngưỡng cảnh báo (số lượng ≤)</label>
                    <input type="number" id="cb-nguong" value="10" min="0" style="width:160px">
                </div>
                <button class="tk-btn" onclick="loadCanhBao()">⚠️ Kiểm tra</button>
            </div>
            <p style="font-size:13px;color:#888;margin-top:-8px;margin-bottom:14px;">
                Hệ thống sẽ liệt kê tất cả sản phẩm có tồn kho nhỏ hơn hoặc bằng ngưỡng bạn nhập.
            </p>

            <div id="canhbao-result">
                <div class="tk-empty">Nhập ngưỡng cảnh báo và nhấn "Kiểm tra"</div>
            </div>
        </div>
    </div>

    <!-- ======================================================
         TAB 4: THỐNG KÊ KHÁCH HÀNG (giữ lại)
         ====================================================== -->
    <div id="tab-khachhang" class="tk-panel">
        <div class="tk-card">
            <h4>👥 Thống kê khách hàng mua nhiều nhất</h4>
            <form id="thongke-form" onsubmit="loadKhachHang(event)">
                <div class="tk-form-row">
                    <div class="tk-form-group">
                        <label>Từ ngày</label>
                        <input type="date" id="kh-start" required>
                    </div>
                    <div class="tk-form-group">
                        <label>Đến ngày</label>
                        <input type="date" id="kh-end" required>
                    </div>
                    <div class="tk-form-group">
                        <label>Số KH cần liệt kê</label>
                        <input type="number" id="kh-top" min="1"
                               max="<?= $maxKhachHang ?>"
                               value="<?= $maxKhachHang ?>"
                               style="width:120px">
                    </div>
                    <div class="tk-form-group">
                        <label>Sắp xếp tổng mua</label>
                        <select id="kh-sort" style="width:140px">
                            <option value="DESC">Giảm dần</option>
                            <option value="ASC">Tăng dần</option>
                        </select>
                    </div>
                    <button type="submit" class="tk-btn">📈 Thống kê</button>
                </div>
            </form>

            <div class="chart-container" style="max-width:600px;margin:0 auto 20px">
                <canvas id="myChart"></canvas>
            </div>

            <div id="kh-result">
                <div class="tk-empty">Chọn khoảng thời gian và nhấn "Thống kê"</div>
            </div>
        </div>
    </div>
</div><!-- end right-content -->

<!-- ===================== SCRIPTS ===================== -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// ============================================================
// Utilities
// ============================================================
function fmtNum(n) {
    return Number(n).toLocaleString('vi-VN');
}
function fmtMoney(n) {
    return Number(n).toLocaleString('vi-VN') + 'đ';
}
function loading(id) {
    document.getElementById(id).innerHTML =
        '<div class="tk-loading">⏳ Đang tải dữ liệu...</div>';
}
function switchTab(tabId, btn) {
    document.querySelectorAll('.tk-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.tk-tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById(tabId).classList.add('active');
    btn.classList.add('active');
}

// ============================================================
// TAB 1: TRA CỨU TỒN KHO
// ============================================================
let debounceTimer;
function debounceTonKho() {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(loadTonKho, 500);
}

function loadTonKho(overrideKeyword) {
    const kw = overrideKeyword !== undefined
               ? overrideKeyword
               : (document.getElementById('tk-keyword').value.trim());
    loading('tonkho-result');

    const fd = new FormData();
    fd.append('action', 'ton_kho');
    fd.append('keyword', kw);

    fetch('../controller/pagThongKe.php', { method: 'POST', body: fd })
        .then(r => r.json())
        .then(res => {
            if (res.status !== 'success') {
                document.getElementById('tonkho-result').innerHTML =
                    '<div class="tk-empty">❌ ' + (res.message || 'Lỗi') + '</div>';
                return;
            }
            renderTonKho(res.data);
        })
        .catch(() => {
            document.getElementById('tonkho-result').innerHTML =
                '<div class="tk-empty">❌ Không thể kết nối server</div>';
        });
}

function renderTonKho(data) {
    const summaryEl = document.getElementById('tk-summary');
    if (data.length === 0) {
        document.getElementById('tonkho-result').innerHTML =
            '<div class="tk-empty">Không tìm thấy sản phẩm phù hợp</div>';
        summaryEl.style.display = 'none';
        return;
    }

    // Tính summary
    const total = data.length;
    const out  = data.filter(d => d.sltonkho == 0).length;
    const low  = data.filter(d => d.sltonkho > 0 && d.sltonkho <= 10).length;
    const ok   = total - out - low;
    document.getElementById('sum-total').textContent = total;
    document.getElementById('sum-ok').textContent = ok;
    document.getElementById('sum-low').textContent = low;
    document.getElementById('sum-out').textContent = out;
    summaryEl.style.display = 'flex';

    let rows = '';
    data.forEach(p => {
        let badge = '';
        const sl = parseInt(p.sltonkho);
        if (sl === 0)       badge = '<span class="badge-danger">Hết hàng</span>';
        else if (sl <= 10)  badge = '<span class="badge-warning">Sắp hết (' + sl + ')</span>';
        else                badge = '<span class="badge-success">Còn hàng</span>';

        rows += `<tr>
            <td>${p.idbanphim}</td>
            <td style="text-align:left;font-weight:600">${p.tenbanphim}</td>
            <td>${p.tenthuonghieu}</td>
            <td>${p.tendanhmuc}</td>
            <td><b style="font-size:16px">${fmtNum(p.sltonkho)}</b></td>
            <td>${fmtMoney(p.gia)}</td>
            <td>${badge}</td>
        </tr>`;
    });

    document.getElementById('tonkho-result').innerHTML = `
        <div class="tk-table-wrap">
            <table class="tk-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Thương hiệu</th>
                        <th>Danh mục</th>
                        <th>Tồn kho</th>
                        <th>Giá bán</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>${rows}</tbody>
            </table>
        </div>`;
}

// ============================================================
// TAB 2: BÁO CÁO NHẬP – XUẤT
// ============================================================
function loadNhapXuat() {
    const start = document.getElementById('nx-start').value;
    const end   = document.getElementById('nx-end').value;

    if (!start || !end) { alert('Vui lòng chọn khoảng thời gian!'); return; }
    if (start > end)    { alert('Ngày bắt đầu không được lớn hơn ngày kết thúc!'); return; }

    loading('nhapxuat-result');

    const fd = new FormData();
    fd.append('action', 'nhap_xuat');
    fd.append('start_date', start);
    fd.append('end_date', end);

    fetch('../controller/pagThongKe.php', { method: 'POST', body: fd })
        .then(r => r.json())
        .then(res => {
            if (res.status !== 'success') {
                document.getElementById('nhapxuat-result').innerHTML =
                    '<div class="tk-empty">❌ ' + (res.message || 'Lỗi') + '</div>';
                return;
            }
            renderNhapXuat(res.data);
        })
        .catch(() => {
            document.getElementById('nhapxuat-result').innerHTML =
                '<div class="tk-empty">❌ Không thể kết nối server</div>';
        });
}

function renderNhapXuat(data) {
    const summaryEl = document.getElementById('nx-summary');
    if (data.length === 0) {
        document.getElementById('nhapxuat-result').innerHTML =
            '<div class="tk-empty">Không có dữ liệu nhập xuất trong khoảng thời gian này</div>';
        summaryEl.style.display = 'none';
        return;
    }

    let totalNhap = 0, totalXuat = 0, totalTienNhap = 0, totalTienXuat = 0;
    let rows = '';
    data.forEach(p => {
        totalNhap     += p.tong_nhap;
        totalXuat     += p.tong_xuat;
        totalTienNhap += p.tong_tien_nhap;
        totalTienXuat += p.tong_tien_xuat;

        const diff = p.tong_nhap - p.tong_xuat;
        const diffStr = diff >= 0
            ? `<span style="color:#27ae60">+${fmtNum(diff)}</span>`
            : `<span style="color:#e74c3c">${fmtNum(diff)}</span>`;

        rows += `<tr>
            <td>${p.idbanphim}</td>
            <td style="text-align:left;font-weight:600">${p.tenbanphim}</td>
            <td><span style="color:#27ae60;font-weight:700">${fmtNum(p.tong_nhap)}</span></td>
            <td>${fmtMoney(p.tong_tien_nhap)}</td>
            <td><span style="color:#e74c3c;font-weight:700">${fmtNum(p.tong_xuat)}</span></td>
            <td>${fmtMoney(p.tong_tien_xuat)}</td>
            <td>${diffStr}</td>
        </tr>`;
    });

    // Summary
    document.getElementById('nx-sum-nhap').textContent = fmtNum(totalNhap);
    document.getElementById('nx-sum-xuat').textContent = fmtNum(totalXuat);
    document.getElementById('nx-sum-tiennhap').textContent = fmtMoney(totalTienNhap);
    document.getElementById('nx-sum-tienxuat').textContent = fmtMoney(totalTienXuat);
    summaryEl.style.display = 'flex';

    document.getElementById('nhapxuat-result').innerHTML = `
        <div class="tk-table-wrap">
            <table class="tk-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>SL nhập</th>
                        <th>Tiền nhập</th>
                        <th>SL xuất</th>
                        <th>Tiền xuất</th>
                        <th>Chênh lệch (nhập - xuất)</th>
                    </tr>
                </thead>
                <tbody>${rows}</tbody>
                <tfoot style="background:#f0f7ff;font-weight:700">
                    <tr>
                        <td colspan="2">Tổng cộng</td>
                        <td style="color:#27ae60">${fmtNum(totalNhap)}</td>
                        <td style="color:#27ae60">${fmtMoney(totalTienNhap)}</td>
                        <td style="color:#e74c3c">${fmtNum(totalXuat)}</td>
                        <td style="color:#e74c3c">${fmtMoney(totalTienXuat)}</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>`;
}

// ============================================================
// TAB 3: CẢNH BÁO SẮP HẾT HÀNG
// ============================================================
function loadCanhBao() {
    const nguong = document.getElementById('cb-nguong').value;
    if (nguong === '' || parseInt(nguong) < 0) {
        alert('Vui lòng nhập ngưỡng hợp lệ (≥ 0)!');
        return;
    }
    loading('canhbao-result');

    const fd = new FormData();
    fd.append('action', 'canh_bao');
    fd.append('nguong', nguong);

    fetch('../controller/pagThongKe.php', { method: 'POST', body: fd })
        .then(r => r.json())
        .then(res => {
            if (res.status !== 'success') {
                document.getElementById('canhbao-result').innerHTML =
                    '<div class="tk-empty">❌ ' + (res.message || 'Lỗi') + '</div>';
                return;
            }
            renderCanhBao(res.data, res.nguong);
        })
        .catch(() => {
            document.getElementById('canhbao-result').innerHTML =
                '<div class="tk-empty">❌ Không thể kết nối server</div>';
        });
}

function renderCanhBao(data, nguong) {
    if (data.length === 0) {
        document.getElementById('canhbao-result').innerHTML =
            `<div class="tk-empty" style="color:#27ae60">
                ✅ Không có sản phẩm nào có tồn kho ≤ ${nguong}. Tất cả đều đủ hàng!
             </div>`;
        return;
    }

    let rows = '';
    data.forEach((p, idx) => {
        const sl = parseInt(p.sltonkho);
        let badgeClass = sl === 0 ? 'badge-danger' : 'badge-warning';
        let urgency = sl === 0 ? '🔴 Hết hàng' : (sl <= 3 ? '🔴 Rất nguy cấp' : '🟡 Sắp hết');

        rows += `<tr style="${sl === 0 ? 'background:#fff5f5' : sl <= 3 ? 'background:#fff9f0' : ''}">
            <td>${idx + 1}</td>
            <td>${p.idbanphim}</td>
            <td style="text-align:left;font-weight:600">${p.tenbanphim}</td>
            <td>${p.tenthuonghieu}</td>
            <td>${p.tendanhmuc}</td>
            <td>
                <span style="font-size:20px;font-weight:700;color:${sl===0?'#e74c3c':sl<=3?'#e67e22':'#f39c12'}">
                    ${fmtNum(sl)}
                </span>
            </td>
            <td>${fmtMoney(p.gia)}</td>
            <td>${urgency}</td>
            <td>
                <a href="../controller/index.php?pg=suasach&idbanphim=${p.idbanphim}"
                   style="background:#2980b9;color:#fff;padding:4px 10px;border-radius:5px;text-decoration:none;font-size:13px">
                   Cập nhật
                </a>
            </td>
        </tr>`;
    });

    document.getElementById('canhbao-result').innerHTML = `
        <div style="background:#fff3cd;border:1px solid #ffc107;border-radius:6px;padding:12px 16px;margin-bottom:14px;font-size:14px">
            ⚠️ Tìm thấy <strong>${data.length}</strong> sản phẩm có tồn kho ≤ <strong>${nguong}</strong>. 
            Vui lòng nhập thêm hàng sớm!
        </div>
        <div class="tk-table-wrap">
            <table class="tk-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Thương hiệu</th>
                        <th>Danh mục</th>
                        <th>Tồn kho</th>
                        <th>Giá bán</th>
                        <th>Mức độ</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>${rows}</tbody>
            </table>
        </div>`;
}

// ============================================================
// TAB 4: THỐNG KÊ KHÁCH HÀNG (giữ nguyên logic cũ)
// ============================================================
let myChart = null;

function loadKhachHang(event) {
    if (event) event.preventDefault();
    const start = document.getElementById('kh-start').value;
    const end   = document.getElementById('kh-end').value;
    const top   = document.getElementById('kh-top').value;
    const sort  = document.getElementById('kh-sort').value;

    if (!start || !end) { alert('Vui lòng chọn khoảng thời gian!'); return; }
    if (start > end)    { alert('Ngày bắt đầu không được lớn hơn ngày kết thúc!'); return; }

    loading('kh-result');

    const fd = new FormData();
    fd.append('action', 'khach_hang');
    fd.append('start_date', start);
    fd.append('end_date', end);
    fd.append('top_kh', top);
    fd.append('sort_order', sort);

    fetch('../controller/pagThongKe.php', { method: 'POST', body: fd })
        .then(r => r.json())
        .then(res => {
            if (res.status !== 'success') {
                document.getElementById('kh-result').innerHTML =
                    '<div class="tk-empty">❌ ' + (res.message || 'Lỗi') + '</div>';
                return;
            }
            renderKhachHang(res.data, sort);
        })
        .catch(() => {
            document.getElementById('kh-result').innerHTML =
                '<div class="tk-empty">❌ Không thể kết nối server</div>';
        });
}

function renderKhachHang(data, sortOrder) {
    if (!data || data.length === 0) {
        document.getElementById('kh-result').innerHTML =
            '<div class="tk-empty">Không có dữ liệu trong khoảng thời gian này</div>';
        if (myChart) { myChart.destroy(); myChart = null; }
        return;
    }

    // Chart
    const sorted = [...data].sort((a, b) =>
        sortOrder === 'ASC' ? a.tong_mua - b.tong_mua : b.tong_mua - a.tong_mua
    );
    const labels = sorted.map(d => d.ten);
    const values = sorted.map(d => parseFloat(d.tong_mua));
    const colors = labels.map((_, i) => `hsl(${(i * 47) % 360}, 65%, 55%)`);

    const ctx = document.getElementById('myChart').getContext('2d');
    if (myChart) myChart.destroy();
    myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Tổng mua (VNĐ)',
                data: values,
                backgroundColor: colors,
                borderWidth: 1
            }]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });

    // Table
    let rows = '';
    sorted.forEach((d, i) => {
        const dsDon = d.ds_don_hang.map((id, j) =>
            `<a href="../controller/index.php?pg=xetduyetHD&idhoadon=${id}&from=thongke"
                style="color:#2980b9">${j+1}-ID:${id}</a>`
        ).join(', ');

        rows += `<tr>
            <td>${i + 1}</td>
            <td style="font-weight:600">${d.ten}</td>
            <td style="text-align:left">${dsDon}</td>
            <td>${d.ds_don_hang.length}</td>
            <td style="font-weight:700;color:#2980b9">${fmtMoney(d.tong_mua)}</td>
        </tr>`;
    });

    document.getElementById('kh-result').innerHTML = `
        <div class="tk-table-wrap">
            <table class="tk-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Khách hàng</th>
                        <th>Đơn hàng</th>
                        <th>Tổng đơn</th>
                        <th>Tổng mua</th>
                    </tr>
                </thead>
                <tbody>${rows}</tbody>
            </table>
        </div>`;
}

// ============================================================
// Khởi tạo: set ngày mặc định hôm nay
// ============================================================
document.addEventListener('DOMContentLoaded', () => {
    const today = new Date().toISOString().split('T')[0];
    const firstDay = today.substring(0, 8) + '01';
    ['nx-start', 'kh-start'].forEach(id => {
        document.getElementById(id).value = firstDay;
    });
    ['nx-end', 'kh-end'].forEach(id => {
        document.getElementById(id).value = today;
    });
    // Tự động tải tồn kho tất cả sản phẩm khi vào tab
    loadTonKho('');
});
</script>