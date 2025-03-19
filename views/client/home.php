 
 <?php include_once ROOT_DIR . "views/client/header.php" ?>

<div class="container mt-5">
    <?php foreach ($categories_with_products as $category): ?>
        <h1 class="mt-5"><?= htmlspecialchars($category['cate_name']) ?></h1>
        <div class="row g-4">
            <?php foreach ($category['products'] as $product): ?>
                <!-- Box Sản Phẩm -->
                <div class="col-md-3">
                    <div class="product-box">
                        <img src="<?= htmlspecialchars($product['image']) ?>" alt="Product Image" class="product-img">
                        <div class="product-info">
                            <a href="<?= ROOT_URL . '?ctl=detail&id=' . htmlspecialchars($product['id']) ?>">
                                <h5 class="product-name"><?= htmlspecialchars($product['name']) ?></h5>
                            </a>
                            <div>
                                <span class="product-price">
                                    <?= number_format($product['price']) ?> vnđ
                                </span>
                            </div>
                            <div class="product-buttons">
                                <a href="<?= ROOT_URL . '?ctl=add-cart&id=' . htmlspecialchars($product['id']) ?>" 
                                   class="btn btn-outline-success">
                                    Thêm vào giỏ hàng
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    <?php endforeach ?>
</div>

<?php include_once ROOT_DIR . "views/client/footer.php" ?>