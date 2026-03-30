<?php // header.php ?>
<!-- Header -->
<header class="row">
    <div class="shopping-mall col-md-10">
        <h1>Book Shopping Mall</h1>
        <h5>Thế giới truyện tranh, tiểu thuyết và nhiều hơn nữa</h5>
    </div>
    <div class="col-md-2 text-right">
        <img class="img-responsive" src="images/header-object.png" alt="Header Image" />
    </div>
</header>

<!-- Navbar -->
<nav class="navbar navbar-inverse" style="margin-bottom: 0;">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Shop</a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <!-- Menu chính -->
            <ul class="nav navbar-nav">
                <li class="active"><a href="#"><span class="glyphicon glyphicon-home"></span> Trang chủ</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-earphone"></span> Liên hệ</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-envelope"></span> Góp ý</a></li>
            </ul>

            <!-- Menu tài khoản -->
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span> 
                            <?php if (isset($_SESSION['user'])): ?>
                                <?= htmlspecialchars($_SESSION['user']['full_name']) ?>
                            <?php else: ?>
                                Tài khoản 
                            <?php endif; ?>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (isset($_SESSION['user'])): ?>
                            <li><a href="index.php?act=logout">Đăng xuất</a></li>
                            <li><a href="change-password.php">Đổi mật khẩu</a></li>
                            <li><a href="update-profile.php">Cập nhật hồ sơ</a></li>

                            <li role="separator" class="divider"></li>

                            <li><a href="orders.php">Đơn hàng</a></li>
                            <li><a href="purchased.php">Hàng đã mua</a></li>
                        <?php else: ?>
                            <li><a href="index.php?act=login">Đăng nhập</a></li>
                            <li><a href="index.php?act=register">Đăng ký</a></li>
                            <li><a href="forgot-password.php">Quên mật khẩu</a></li>
                        <?php endif; ?>
                            
                            <li role="separator" class="divider"></li>

                            <li><a href="admin.php">Đăng nhập trang quản trị</a></li>
                            
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>