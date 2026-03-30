<?php global $categories; ?>
<aside class="col-sm-3">
    <!-- Search box -->
    <div class="panel panel-default">
        <div class="panel-body">
            <form method="GET" action="index.php">
                <input type="hidden" name="act" value="/">
                <input type="text" name="keyword" placeholder="Tìm sản phẩm..."
                    value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>" class="form-control" />
                <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Tìm</button>
            </form>
        </div>
    </div>

    <!-- Category list -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-th-list"></span>
            <strong>Danh Mục Sản Phẩm</strong>
        </div>
        <div class="list-group">
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $category): ?>
                    <a href="index.php?act=product_by_category&category_id=<?= $category['category_id'] ?>" class="list-group-item">
                        <?= htmlspecialchars($category['category_name']) ?>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <span class="list-group-item">Không có danh mục</span>
            <?php endif; ?>
        </div>
    </div>
</aside>