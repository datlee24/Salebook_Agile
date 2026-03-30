<?php 

// Biến môi trường, dùng chung toàn hệ thống
// Khai báo dưới dạng HẰNG SỐ để không phải dùng $GLOBALS

define('BASE_URL'       , 'http://localhost/WEBSITE_BOOK/');

define('DB_HOST'    , 'localhost');
define('DB_PORT'    , 3306);
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME'    , 'booksale');  // Tên database

define('PATH_ROOT'    , __DIR__ . '/../');
// Cấu hình thư mục phần giao diện người dùng
define('PATH_CLIENT', PATH_ROOT . '/views/client/');
// Cấu hình thư mục phần giao diện quản trị
define('PATH_ADMIN', PATH_ROOT . '/views/admin/');

// Cấu hình thư mục chứa các file tĩnh (CSS, JS, hình ảnh)
define('PATH_PUBLIC', PATH_ROOT . 'public/');
// Cấu hình thư mục chứa các file upload
define('PATH_UPLOAD', PATH_ROOT . 'uploads/');