<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sản phẩm - Nettruyen Mall</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 3 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="public/main.css">
    <style>
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }
        .product {
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }
        .product img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 4px;
        }
        .product .price {
            color: red;
            font-weight: bold;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <?php headerClient() ?>

        <h2 class="text-center">Danh sách sản phẩm theo danh mục</h2>
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

        <!-- Footer -->
        <?php footerClient() ?>
    </div>
</body>
</html>