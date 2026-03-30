<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết sản phẩm - Nettruyen Mall</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 3 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="public/main.css">
    <style>
        .detail-container {
            display: flex;
            gap: 40px;
            max-width: 1000px;
            margin: auto;
            padding: 20px 0;
        }
        .detail-container img {
            width: 400px;
            height: 400px;
            object-fit: cover;
            border-radius: 8px;
        }
        .detail-info {
            flex: 1;
        }
        .detail-info h2 {
            margin-top: 0;
        }
        .price {
            font-size: 24px;
            color: red;
            font-weight: bold;
            margin: 10px 0;
        }
        .description {
            margin: 20px 0;
        }
        .error-message {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <?php headerClient() ?>

        <!-- Product Detail -->
        <?php 
        if (isset($product) && is_array($product)) {
            $imagePath = "Uploads/imgproduct/" . htmlspecialchars($product['cover_image'] ?? '');
            $defaultImage = "Uploads/imgproduct/default.jpg";
        ?>
            <div class="detail-container">
                <div>
                    <img src="<?= file_exists($imagePath) ? $imagePath : $defaultImage ?>" 
                         alt="<?= htmlspecialchars($product['title'] ?? 'Sản phẩm') ?>">
                </div>
                <div class="detail-info">
                    <h2><?= htmlspecialchars($product['title'] ?? 'Không có tiêu đề') ?></h2>
                    <p><strong>Tác giả:</strong> <?= htmlspecialchars($product['author_name'] ?? 'Không xác định') ?></p>
                    <p><strong>Danh mục:</strong> <?= htmlspecialchars($product['category_name'] ?? 'Không xác định') ?></p>
                    <p class="price"><?= number_format($product['price'] ?? 0, 0, ',', '.') ?>đ</p>
                    <p><strong>Số lượng trong kho:</strong> <?= $product['stock_quantity'] ?? 0 ?></p>
                    <p class="description"><strong>Mô tả:</strong> <?= htmlspecialchars($product['description'] ?? 'Không có mô tả') ?></p>
                    
                </div>
            </div>

            <!-- Phần bình luận -->
            <div class="panel panel-default" style="max-width: 1000px; margin: 30px auto;">
                <div class="panel-heading"><strong>Bình luận</strong></div>
                <div class="panel-body">
                    <?php if (!empty($comments)) { ?>
                        <?php foreach ($comments as $comment) { ?>
                            <div style="margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                                <strong><?= htmlspecialchars($comment['full_name'] ?? 'Ẩn danh') ?></strong>
                                <span style="color: #888; font-size: 12px;">
                                    <?= htmlspecialchars($comment['created_at'] ?? '') ?>
                                </span>
                                <div><?= nl2br(htmlspecialchars($comment['comment_text'] ?? '')) ?></div>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div>Chưa có bình luận nào.</div>
                    <?php } ?>
                </div>
            </div>

            <!-- Phần gửi bình luận -->
            <?php if (isset($_SESSION['user'])): ?>
                <div class="panel panel-default" style="max-width: 1000px; margin: 0 auto 30px;">
                    <div class="panel-heading"><strong>Gửi bình luận của bạn</strong></div>
                    <div class="panel-body">
                        <form action="index.php?act=send_comment" method="post">
                            <input type="hidden" name="book_id" value="<?= htmlspecialchars($product['book_id']) ?>">
                            <div class="form-group">
                                <textarea name="comment_text" class="form-control" rows="3" placeholder="Nhập bình luận..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi bình luận</button>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div style="max-width: 1000px; margin: 0 auto 30px; text-align:center;">
                    <a href="index.php?act=login">Đăng nhập</a> để bình luận.
                </div>
            <?php endif; ?>
        <?php } else { ?>
            <div class="error-message">Không tìm thấy thông tin sản phẩm!</div>
        <?php } ?>

        <!-- Footer -->
        <?php footerClient() ?>
    </div>
</body>
</html>