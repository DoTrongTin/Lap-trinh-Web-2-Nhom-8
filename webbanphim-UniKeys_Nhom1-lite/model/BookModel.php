<?php
class BookModel {
    private $conn;

    public function __construct() {
        // Lấy kết nối từ connectDB.php
        $this->conn = connectdb(); // Sử dụng hàm connectdb()
    }

    // Lấy thông tin sách theo ID
    public function getBookById($bookId) {
        $stmt = $this->conn->prepare("
            SELECT s.idbanphim, s.tenbanphim, s.gia, s.sltonkho, s.mota, s.anhbia,
                   t.tenthuonghieu, nxb.tennpp, ctdm.tenchitietdanhmuc, ctdm.idchitietdanhmuc,
                   dm.tendanhmuc, dm.iddanhmuc
            FROM banphim s
            JOIN thuonghieu t ON s.idthuonghieu = t.idthuonghieu
            JOIN nhaphanphoi nxb ON s.idnhaphaphoi = nxb.idnhaphaphoi
            JOIN chitietdanhmuc ctdm ON s.idctdanhmuc = ctdm.idchitietdanhmuc
            JOIN danhmuc dm ON ctdm.iddanhmuc = dm.iddanhmuc
            WHERE s.idbanphim = ? AND s.trangthai = 1
        ");
        $stmt->execute([(int)$bookId]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Lấy danh sách hình ảnh của sách
    public function getBookImages($bookId) {
        $stmt = $this->conn->prepare("
            SELECT duongdananh
            FROM hinhanhsach
            WHERE idbanphim = ? AND trangthai = 1
        ");
        $stmt->execute([(int)$bookId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Lấy sách liên quan (cùng chi tiết danh mục, loại trừ sách hiện tại)
    public function getRelatedBooks($categoryId, $bookId) {
        $stmt = $this->conn->prepare("
            SELECT s.idbanphim, s.tenbanphim, s.gia, s.anhbia, t.tenthuonghieu
            FROM banphim s
            JOIN thuonghieu t ON s.idthuonghieu = t.idthuonghieu
            WHERE s.idctdanhmuc = ? AND s.idbanphim != ? AND s.trangthai = 1
            LIMIT 4
        ");
        $stmt->execute([(int)$categoryId, (int)$bookId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Lấy sản phẩm nổi bật (dựa trên số lượng tồn kho cao hoặc số lượng bán)
    public function getFeaturedBooks() {
        $stmt = $this->conn->prepare("
            SELECT s.idbanphim, s.tenbanphim, s.gia, s.anhbia, t.tenthuonghieu
            FROM banphim s
            JOIN thuonghieu t ON s.idthuonghieu = t.idthuonghieu
            WHERE s.trangthai = 1
            ORDER BY s.sltonkho DESC
            LIMIT 4
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Lấy sách theo danh mục (iddanhmuc)
    public function getBooksByCategory($categoryId) {
        $stmt = $this->conn->prepare("
            SELECT s.idbanphim, s.tenbanphim, s.gia, s.anhbia, t.tenthuonghieu
            FROM banphim s
            JOIN thuonghieu t ON s.idthuonghieu = t.idthuonghieu
            JOIN chitietdanhmuc ctdm ON s.idctdanhmuc = ctdm.idchitietdanhmuc
            WHERE ctdm.iddanhmuc = ? AND s.trangthai = 1
            LIMIT 4
        ");
        $stmt->execute([(int)$categoryId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Lấy sách hay (dựa trên số lượng tồn kho thấp - giả định sách bán chạy)
    public function getRecommendedBooks() {
        $stmt = $this->conn->prepare("
            SELECT s.idbanphim, s.tenbanphim, s.gia, s.anhbia, t.tenthuonghieu
            FROM banphim s
            JOIN thuonghieu t ON s.idthuonghieu = t.idthuonghieu
            WHERE s.trangthai = 1
            ORDER BY s.sltonkho ASC
            LIMIT 4
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
?>