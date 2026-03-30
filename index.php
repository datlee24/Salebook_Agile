<?php
// Đây là file index.php, điểm vào chính của trang người dùng

// Khởi tạo session
session_start();

// Require các file cần thiết
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Tải các controller, model
// Sử dụng vòng lặp foreach để lấy từng file có đuôi .php và tải

# Tải các controller người dùng (trong thư mục controllers/client)
foreach (glob('./controllers/client/*.php') as $controllerFile) {
    require_once $controllerFile;
}

# Tải các model (sử dụng chung cho cả người dùng và quản trị)
foreach (glob('./models/*.php') as $modelFile) {
    require_once $modelFile;
}

// Lấy danh mục 1 lần duy nhất
$categoryModel = new CategoryModel();
$categories = $categoryModel->getAll();

// Route
$act = $_GET['act'] ?? '/';

// Điều hướng (trang người dùng)
// Các controller nằm trong thư mục controllers/client
match ($act) {
    // Trang chủ: Hiển thị danh sách sản phẩm
    '/' => (new ProductController())->showAll(),
    // Chi tiết sản phẩm
    'product_detail' => (new ProductController())->detail(),

    // // Gửi bình luận
    // 'send_comment' => (new ProductController())->sendComment(),

    // 'login' => (new AuthController())->login(),
    // 'logout' => (new AuthController())->logout(),
    // 'register' => (new AuthController())->register(),

    // // Danh sách sản phẩm theo danh mục
    // 'product_by_category' => (new ProductController())->byCategory(),

    // // Mặc định: Chuyển về trang chủ nếu action không hợp lệ
    // default => (new ProductController())->showAll(),

};