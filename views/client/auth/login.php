<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Online Shopping Mall</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 3 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Custom CSS & JS -->
    <link rel="stylesheet" href="public/main.css">
    <script defer src="public/main.js"></script>

    <style>
        /* Đảm bảo container chính căn giữa và có padding đều */
        .container {
            padding: 20px 0;
        }

        /* Tùy chỉnh slider (giữ nguyên kích thước và căn giữa) */
        .slider {
            position: relative;
            width: 100%;
            height: 300px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        /* Đảm bảo sản phẩm trong grid đều nhau */
        .poly-prod {
            margin-bottom: 20px;
            /* Khoảng cách dưới bằng nhau */
            height: 400px;
            /* Chiều cao cố định cho mỗi sản phẩm */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .panel {
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .panel-body {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }

        .panel-body img {
            max-width: 100%;
            max-height: 200px;
            /* Chiều cao hình ảnh cố định */
            object-fit: cover;
            border-radius: 4px;
        }

        .panel-heading,
        .panel-footer {
            padding: 10px;
            text-align: center;
        }

        .panel-heading a {
            color: #333;
            text-decoration: none;
        }

        .panel-heading a:hover {
            color: #007bff;
        }

        .panel-footer {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        /* Đảm bảo grid thẳng hàng và đều nhau */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .col-sm-4 {
            padding: 0 15px;
            box-sizing: border-box;
        }

        /* Sidebar */
        .panel-default {
            margin-bottom: 20px;
        }

        /* Tùy chỉnh form tìm kiếm */
        .panel-body form {
            display: flex;
            flex-direction: column;
        }

        .panel-body input[type="text"] {
            margin-bottom: 10px;
        }

        .login-form-container {
            max-width: 700px;
            margin: 60px auto 0 auto;
            padding: 30px 25px 25px 25px;
            background: #fff;
            border-radius: 8px;
        }

        .login-form-container h2 {
            margin-bottom: 25px;
        }

        .login-form-container .form-group {
            margin-bottom: 18px;
        }

        .login-form-container label {
            font-weight: 500;
        }

        .login-form-container input[type="text"],
        .login-form-container input[type="password"] {
            border-radius: 4px;
            border: 1px solid #ccc;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
        }

        .login-form-container button[type="submit"] {
            max-width: 200px;
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        .login-form-container button[type="submit"]:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">

        <!-- Header -->
        <?php headerClient() ?>

        <!-- Banner slider -->
        <section class="slider">
            <div class="slides">
                <img src="Uploads/imgproduct/slider1.jpg" class="active">
                <img src="Uploads/imgproduct/slider2.jpg">
                <img src="Uploads/imgproduct/slider3.jpg">
            </div>
            <div class="prev">&#10094;</div>
            <div class="next">&#10095;</div>
        </section>

        <!-- Main layout -->
        <div class="row">
            <!-- Product Section -->
            <article class="col-sm-9">
                <div class="login-form-container">
                    <h2 class="text-center">Đăng nhập</h2>
                    <form method="post" action="index.php?act=login">

                        <?php if (isset($_SESSION['success'])): ?>
                            <div class="form-group">
                                <span class="text-success"><?= $_SESSION['success'] ?></span>
                            </div>
                            <?php unset($_SESSION['success']); ?>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="form-group">
                                <span class="text-danger"><?= $_SESSION['error'] ?></span>
                            </div>
                            <?php unset($_SESSION['error']); ?>
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <p>Chưa có tài khoản ? <a href="index.php?act=register">Đăng ký</a> ngay</p>
                        <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                    </form>
                </div>
            </article>

            <!-- Sidebar -->
            <?php sidebarClient() ?>
        </div>

        <!-- Footer -->
        <?php footerClient() ?>

    </div>
</body>

</html>