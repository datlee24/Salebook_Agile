<?php

class AuthController
{
    protected $userModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->categoryModel = new CategoryModel();
        $categories = $this->categoryModel->getAll();
    }

    // Đăng nhập trang người dùng
    public function login()
    {
        // phần kiểm tra trạng thái đăng nhập
        if (isset($_SESSION['user'])) {
            // Nếu đã đăng nhập, chuyển hướng về trang chủ
            $_SESSION['error'] = "Bạn đã đăng nhập rồi!";
            header('Location: index.php');
            exit;
        }

        // phần xử lý đăng nhập khi người dùng gửi thông tin đăng nhập
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Kiểm tra người dùng bằng email
            $user = $this->userModel->checkEmail($email);
            // Nếu tìm thấy người dùng
            if ($user) {
                // Kiểm tra mật khẩu
                // Nếu mật khẩu đúng
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user'] = $user;
                    header('Location: index.php');
                    exit;
                }
                // Nếu mật khẩu không đúng
                else {
                    // Mật khẩu không đúng
                    $_SESSION['error'] = "Sai mật khẩu";
                    header('Location: index.php?act=login');
                    exit;
                }
            } 
            // Nếu không tìm thấy người dùng
            else {
                // Tài khoản không tồn tại
                $_SESSION['error'] = "Tài khoản không tồn tại";
                header('Location: index.php?act=login');
                exit;
            }
        }

        // phần hiển thị giao diện đăng nhập
        require_once PATH_CLIENT . '/auth/login.php';
    }

    // Đăng ký trang người dùng
    public function register()
    {
        // phần kiểm tra trạng thái đăng nhập
        if (isset($_SESSION['user'])) {
            // Nếu đã đăng nhập, chuyển hướng về trang chủ
            $_SESSION['error'] = "Bạn đã đăng nhập rồi!";
            header('Location: index.php');
            exit;
        }

        // phần xử lý đăng ký khi người dùng gửi thông tin đăng ký
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $full_name = $_POST['full_name'] ?? '';
            $email = $_POST['email'] ??'';
            $phone = $_POST['phone'] ?? '';
            $address = $_POST['address'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            // Kiểm tra xem email đã tồn tại chưa
            $user = $this->userModel->checkEmail($email);
            if ($user) {
                $_SESSION['error'] = "Email đã được sử dụng";
                header('Location: index.php?act=register');
                exit;
            }

            // Kiểm tra mật khẩu và xác nhận mật khẩu
            if ($password !== $confirm_password) {
                $_SESSION['error'] = "Mật khẩu không khớp";
                header('Location: index.php?act=register');
                exit;
            }

            // Kiểm tra các trường bắt buộc
            if (empty($full_name) || empty($email) || empty($phone) || empty($address) || empty($password)) {
                $_SESSION['error'] = "Vui lòng điền đầy đủ thông tin";
                header('Location: index.php?act=register');
                exit;
            }

            // Mã hóa mật khẩu
            $hash = password_hash($password, PASSWORD_DEFAULT);

            // Lưu thông tin người dùng mới vào cơ sở dữ liệu
            $this->userModel->addUser(
                $full_name,
                $email,
                $hash,
                $phone,
                $address
            );
            $_SESSION['success'] = "Đăng ký thành công! Vui lòng đăng nhập.";
            header('Location: index.php?act=login');
            exit;
        }

        // phần hiển thị giao diện đăng ký
        require_once PATH_CLIENT . 'auth/register.php';
    }

    // Đăng xuất trang người dùng
    public function logout()
    {
        // Xóa session người dùng
        unset($_SESSION['user']);
        // Chuyển hướng về trang đăng nhập
        header('Location: index.php');
        exit;
    }
}