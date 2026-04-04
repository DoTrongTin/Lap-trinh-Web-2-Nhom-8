<?php
if (!defined('APP_PATH')) {
    define('APP_PATH', __DIR__ . '/..');
}

if (!defined('BASE_URL')) {
    define('BASE_URL', '../../'); // Điều chỉnh đường dẫn gốc của dự án
}

require_once __DIR__ . '/../../model/BookModel.php';

// Khởi tạo model
$bookModel = new BookModel();

// Truy vấn dữ liệu cho các danh mục
$featuredBooks = $bookModel->getFeaturedBooks(); // Sản phẩm nổi bật
$literatureBooks = $bookModel->getBooksByCategory(1); // Sản phẩm văn học (iddanhmuc = 1)
$economicsBooks = $bookModel->getBooksByCategory(7); // Sản phẩm kinh tế (iddanhmuc = 7)
$scienceBooks = $bookModel->getBooksByCategory(2); // Sản phẩm khoa học (iddanhmuc = 2)
$childrenBooks = $bookModel->getBooksByCategory(3); // Sản phẩm thiếu nhi (iddanhmuc = 3)
$selfHelpBooks = $bookModel->getBooksByCategory(4); // Sản phẩm phát triển bản thân (iddanhmuc = 4)
$languageBooks = $bookModel->getBooksByCategory(6); // Sản phẩm tin học ngoại ngữ (iddanhmuc = 6)
$recommendedBooks = $bookModel->getRecommendedBooks(); // Sản phẩm hay
?>

<div class="box-block-main-content">
    <!-- Sản phẩm nổi bật -->
    <div class="block-item-products product-hot">
        <div class="block-item-products">
            <h1 class="text-title">Sản phẩm nổi bật</h1>
            <div class="block-list-item-khuyen-mai flex-item">
                <?php if (!empty($featuredBooks)): ?>
                    <?php foreach ($featuredBooks as $book): ?>
                        <div class="item-product">
                            <div class="box-item-product">
                                <div class="img-item-product">
                                    <a href="../controller/index.php?pg=chitietsp&id=<?php echo htmlspecialchars($book->idbanphim); ?>">
                                        <img src="<?php echo BASE_URL . htmlspecialchars($book->anhbia); ?>" alt="<?php echo htmlspecialchars($book->tenbanphim); ?>">
                                    </a>
                                </div>
                                <div class="box-description-item">
                                    <a href="../controller/index.php?pg=chitietsp&id=<?php echo htmlspecialchars($book->idbanphim); ?>">
                                        <h1><?php echo htmlspecialchars($book->tenbanphim); ?></h1>
                                        <h2>Thương hiệu: <?php echo htmlspecialchars($book->tenthuonghieu); ?></h2>
                                    </a>
                                    <div class="price">
                                        <span><b><?php echo number_format($book->gia, 0, ',', '.'); ?></b></span>
                                        <span class="price-old">
                                            <del><?php echo number_format($book->gia * 1.2, 0, ',', '.'); ?></del>
                                            <label class="label-discount"><?php echo round((($book->gia * 1.2 - $book->gia) / ($book->gia * 1.2)) * 100); ?>%</label>
                                        </span>
                                    </div>
                                    <div class="box-add-to-card">
                                        <i class="icon-cart cartModal" data-id="modal-them-vao-gio-hang" data-idbanphim="<?php echo htmlspecialchars($book->idbanphim); ?>"></i>
                                        <button class="green buy-now-custom" data-idbanphim="<?php echo htmlspecialchars($book->idbanphim); ?>">Mua ngay</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Không có sản phẩm nổi bật.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Sản phẩm văn học -->
        <div class="block-item-products">
            <h1 class="text-title">Bàn phím cơ</h1>
            <div class="block-list-item-khuyen-mai flex-item">
                <?php if (!empty($literatureBooks)): ?>
                    <?php foreach ($literatureBooks as $book): ?>
                        <div class="item-product">
                            <div class="box-item-product">
                                <div class="img-item-product">
                                    <a href="../controller/index.php?pg=chitietsp&id=<?php echo htmlspecialchars($book->idbanphim); ?>">
                                        <img src="<?php echo BASE_URL . htmlspecialchars($book->anhbia); ?>" alt="<?php echo htmlspecialchars($book->tenbanphim); ?>">
                                    </a>
                                </div>
                                <div class="box-description-item">
                                    <a href="../controller/index.php?pg=chitietsp&id=<?php echo htmlspecialchars($book->idbanphim); ?>">
                                        <h1><?php echo htmlspecialchars($book->tenbanphim); ?></h1>
                                        <h2>Thương hiệu: <?php echo htmlspecialchars($book->tenthuonghieu); ?></h2>
                                    </a>
                                    <div class="price">
                                        <span><b><?php echo number_format($book->gia, 0, ',', '.'); ?></b></span>
                                        <span class="price-old">
                                            <del><?php echo number_format($book->gia * 1.2, 0, ',', '.'); ?></del>
                                            <label class="label-discount"><?php echo round((($book->gia * 1.2 - $book->gia) / ($book->gia * 1.2)) * 100); ?>%</label>
                                        </span>
                                    </div>
                                    <div class="box-add-to-card">
                                        <i class="icon-cart cartModal" data-id="modal-them-vao-gio-hang" data-idbanphim="<?php echo htmlspecialchars($book->idbanphim); ?>"></i>
                                        <button class="green buy-now-custom" data-idbanphim="<?php echo htmlspecialchars($book->idbanphim); ?>">Mua ngay</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Không có bàn phím cơ.</p>
                <?php endif; ?>
            </div>
            <div class="view-more">
                <a href="../controller/index.php?pg=sanpham&iddanhmuc=1">
                    Xem thêm <span>những</span> <span>bàn phím cơ khác</span>
                    <div class="block-arrow-down"><i class="icon-btn-next"></i><i class="icon-btn-next"></i></div>
                </a>
            </div>
        </div>

        <!-- Sản phẩm khoa học -->
        <div class="block-item-products">
            <h1 class="text-title">Keycap</h1>
            <div class="block-list-item-khuyen-mai flex-item">
                <?php if (!empty($scienceBooks)): ?>
                    <?php foreach ($scienceBooks as $book): ?>
                        <div class="item-product">
                            <div class="box-item-product">
                                <div class="img-item-product">
                                    <a href="../controller/index.php?pg=chitietsp&id=<?php echo htmlspecialchars($book->idbanphim); ?>">
                                        <img src="<?php echo BASE_URL . htmlspecialchars($book->anhbia); ?>" alt="<?php echo htmlspecialchars($book->tenbanphim); ?>">
                                    </a>
                                </div>
                                <div class="box-description-item">
                                    <a href="../controller/index.php?pg=chitietsp&id=<?php echo htmlspecialchars($book->idbanphim); ?>">
                                        <h1><?php echo htmlspecialchars($book->tenbanphim); ?></h1>
                                        <h2>Thương hiệu: <?php echo htmlspecialchars($book->tenthuonghieu); ?></h2>
                                    </a>
                                    <div class="price">
                                        <span><b><?php echo number_format($book->gia, 0, ',', '.'); ?></b></span>
                                        <span class="price-old">
                                            <del><?php echo number_format($book->gia * 1.2, 0, ',', '.'); ?></del>
                                            <label class="label-discount"><?php echo round((($book->gia * 1.2 - $book->gia) / ($book->gia * 1.2)) * 100); ?>%</label>
                                        </span>
                                    </div>
                                    <div class="box-add-to-card">
                                        <i class="icon-cart cartModal" data-id="modal-them-vao-gio-hang" data-idbanphim="<?php echo htmlspecialchars($book->idbanphim); ?>"></i>
                                        <button class="green buy-now-custom" data-idbanphim="<?php echo htmlspecialchars($book->idbanphim); ?>">Mua ngay</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Không có keycap.</p>
                <?php endif; ?>
            </div>
            <div class="view-more">
                <a href="../controller/index.php?pg=sanpham&iddanhmuc=2">
                    Xem thêm <span>những</span> <span>keycap khác</span>
                    <div class="block-arrow-down"><i class="icon-btn-next"></i><i class="icon-btn-next"></i></div>
                </a>
            </div>
        </div>

        <!-- Sản phẩm thiếu nhi -->
        <div class="block-item-products">
            <h1 class="text-title">Switch</h1>
            <div class="block-list-item-khuyen-mai flex-item">
                <?php if (!empty($childrenBooks)): ?>
                    <?php foreach ($childrenBooks as $book): ?>
                        <div class="item-product">
                            <div class="box-item-product">
                                <div class="img-item-product">
                                    <a href="../controller/index.php?pg=chitietsp&id=<?php echo htmlspecialchars($book->idbanphim); ?>">
                                        <img src="<?php echo BASE_URL . htmlspecialchars($book->anhbia); ?>" alt="<?php echo htmlspecialchars($book->tenbanphim); ?>">
                                    </a>
                                </div>
                                <div class="box-description-item">
                                    <a href="../controller/index.php?pg=chitietsp&id=<?php echo htmlspecialchars($book->idbanphim); ?>">
                                        <h1><?php echo htmlspecialchars($book->tenbanphim); ?></h1>
                                        <h2>Thương hiệu: <?php echo htmlspecialchars($book->tenthuonghieu); ?></h2>
                                    </a>
                                    <div class="price">
                                        <span><b><?php echo number_format($book->gia, 0, ',', '.'); ?></b></span>
                                        <span class="price-old">
                                            <del><?php echo number_format($book->gia * 1.2, 0, ',', '.'); ?></del>
                                            <label class="label-discount"><?php echo round((($book->gia * 1.2 - $book->gia) / ($book->gia * 1.2)) * 100); ?>%</label>
                                        </span>
                                    </div>
                                    <div class="box-add-to-card">
                                        <i class="icon-cart cartModal" data-id="modal-them-vao-gio-hang" data-idbanphim="<?php echo htmlspecialchars($book->idbanphim); ?>"></i>
                                        <button class="green buy-now-custom" data-idbanphim="<?php echo htmlspecialchars($book->idbanphim); ?>">Mua ngay</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Không có switch.</p>
                <?php endif; ?>
            </div>
            <div class="view-more">
                <a href="../controller/index.php?pg=sanpham&iddanhmuc=3">
                    Xem thêm <span>những</span> <span>switch khác</span>
                    <div class="block-arrow-down"><i class="icon-btn-next"></i><i class="icon-btn-next"></i></div>
                </a>
            </div>
        </div>

        <!-- Sản phẩm hay -->
        <div class="block-item-products">
            <h1 class="text-title">Combo hot</h1>
            <div class="block-list-item-khuyen-mai flex-item">
                <?php if (!empty($recommendedBooks)): ?>
                    <?php foreach ($recommendedBooks as $book): ?>
                        <div class="item-product">
                            <div class="box-item-product">
                                <div class="img-item-product">
                                    <a href="../controller/index.php?pg=chitietsp&id=<?php echo htmlspecialchars($book->idbanphim); ?>">
                                        <img src="<?php echo BASE_URL . htmlspecialchars($book->anhbia); ?>" alt="<?php echo htmlspecialchars($book->tenbanphim); ?>">
                                    </a>
                                </div>
                                <div class="box-description-item">
                                    <a href="../controller/index.php?pg=chitietsp&id=<?php echo htmlspecialchars($book->idbanphim); ?>">
                                        <h1><?php echo htmlspecialchars($book->tenbanphim); ?></h1>
                                        <h2>Thương hiệu: <?php echo htmlspecialchars($book->tenthuonghieu); ?></h2>
                                    </a>
                                    <div class="price">
                                        <span><b><?php echo number_format($book->gia, 0, ',', '.'); ?></b></span>
                                        <span class="price-old">
                                            <del><?php echo number_format($book->gia * 1.2, 0, ',', '.'); ?></del>
                                            <label class="label-discount"><?php echo round((($book->gia * 1.2 - $book->gia) / ($book->gia * 1.2)) * 100); ?>%</label>
                                        </span>
                                    </div>
                                    <div class="box-add-to-card">
                                        <i class="icon-cart cartModal" data-id="modal-them-vao-gio-hang" data-idbanphim="<?php echo htmlspecialchars($book->idbanphim); ?>"></i>
                                        <button class="green buy-now-custom" data-idbanphim="<?php echo htmlspecialchars($book->idbanphim); ?>">Mua ngay</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Không có combo hot.</p>
                <?php endif; ?>
            </div>
            <div class="view-more">
                <a href="../controller/index.php">
                    Xem thêm <span>những</span> <span>combo hot khác</span>
                    <div class="block-arrow-down"><i class="icon-btn-next"></i><i class="icon-btn-next"></i></div>
                </a>
            </div>
        </div>
    </div>
</div>
</aside>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    console.log('jQuery loaded and document ready');

    if ($('#modal-them-vao-gio-hang').length) {
        console.log('Modal #modal-them-vao-gio-hang exists in DOM');
    } else {
        console.log('Modal #modal-them-vao-gio-hang NOT found in DOM');
    }

    var idKhachHang = <?php echo isset($_SESSION['idkhachhang']) ? json_encode($_SESSION['idkhachhang']) : 'null'; ?>;
    console.log('idKhachHang:', idKhachHang);

    $('.cartModal').click(function(e) {
        e.preventDefault();
        console.log('Cart icon clicked');
        var idSach = $(this).data('idbanphim');
        console.log('idSach:', idSach);

        if (idKhachHang === null) {
            console.log('User not logged in, redirecting to login');
            alert('Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng!');
            window.location.href = '../controller/index.php?pg=dangnhap';
            return;
        }

        // Thử hiển thị modal thủ công
        // console.log('Showing modal manually for testing');
        // $('#modal-them-vao-gio-hang').addClass('block-modal-active');
        // setTimeout(function() {
        //     console.log('Hiding modal after 3 seconds');
        //     $('#modal-them-vao-gio-hang').removeClass('block-modal-active');
        // }, 3000);

        // Gửi AJAX như bình thường
        $.ajax({
            url: '../controller/giohang.php',
            type: 'POST',
            data: {
                action: 'them',
                idKhachHang: idKhachHang,
                idSach: idSach,
                soLuong: 1
            },
            dataType: 'json',
            success: function(response) {
                console.log('AJAX success:', response);
                if (response.status === 'success') {
                    console.log('Showing modal');
                    $('#modal-them-vao-gio-hang').addClass('block-modal-active');
                    setTimeout(function() {
                        console.log('Hiding modal after 3 seconds');
                        $('#modal-them-vao-gio-hang').removeClass('block-modal-active');
                    }, 3000);
                    loadCartItems();
                } else {
                    console.log('AJAX success but status is not "success":', response);
                    alert('Lỗi: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX error:', xhr.responseText, status, error);
                alert('Đã có lỗi xảy ra khi thêm vào giỏ hàng.');
            }
        });
    });

    // Xử lý khi click vào nút "Mua ngay"
    $('.buy-now-custom').click(function(e) {
        e.preventDefault();
        console.log('Buy now clicked');
        var idSach = $(this).data('idbanphim');
        console.log('idSach:', idSach);

        if (idKhachHang === null) {
            console.log('User not logged in, redirecting to login');
            alert('Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng!');
            window.location.href = '../controller/index.php?pg=dangnhap';
            return;
        }

        $.ajax({
            url: '../controller/giohang.php',
            type: 'POST',
            data: {
                action: 'them',
                idKhachHang: idKhachHang,
                idSach: idSach,
                soLuong: 1
            },
            dataType: 'json',
            success: function(response) {
                console.log('AJAX success:', response);
                if (response.status === 'success') {
                    window.location.href = '../controller/index.php?pg=giohang';
                } else {
                    alert('Lỗi: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX error:', xhr.responseText, status, error);
                alert('Đã có lỗi xảy ra khi thêm vào giỏ hàng.');
            }
        });
    });

    // Đóng modal
    $('.closepopup').click(function() {
        console.log('Close modal clicked');
        $('#modal-them-vao-gio-hang').removeClass('block-modal-active');
    });
});
</script>