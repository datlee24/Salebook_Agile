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

match ($act) {
    // Trang chủ
    '/'=>(new ProductController())->Home(),

};