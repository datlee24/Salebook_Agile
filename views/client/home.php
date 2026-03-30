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
            margin-bottom: 20px; /* Khoảng cách dưới bằng nhau */
            height: 400px; /* Chiều cao cố định cho mỗi sản phẩm */
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
            max-height: 200px; /* Chiều cao hình ảnh cố định */
            object-fit: cover;
            border-radius: 4px;
        }

        .panel-heading, .panel-footer {
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

        <!-- Modal alert show session error-->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger text-center">
                <?= htmlspecialchars($_SESSION['error']) ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

    <!-- Main layout -->
    <div class="row">


        <!-- Product Section -->
        <article class="col-sm-9">
            <h2 class="text-center">Danh sách sản phẩm</h2>
            <div class="row">
                <?php if (!empty($products)) : ?>
                    <?php foreach ($products as $item): ?>
                        <div class="col-sm-4 poly-prod">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="index.php?act=product_detail&id=<?= $item['book_id'] ?>">
                                            <?= htmlspecialchars($item['title']) ?>
                                        </a>
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    <img src="Uploads/imgproduct/<?= htmlspecialchars($item['cover_image']) ?>" 
                                         alt="<?= htmlspecialchars($item['title']) ?>">
                                </div>
                                <div class="panel-footer">
                                    <?= number_format($item['price'], 0, ',', '.') ?>đ
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center">Không có sản phẩm nào!</p>
                <?php endif; ?>
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