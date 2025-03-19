<?php include_once ROOT_DIR . "views/client/header.php" ?>

<div class="container mt-5">
    <div class="mb-5">
        <a href="<?= ROOT_URL ?>">Trang chủ</a> >>
        <b><?= $title ?></b>
    </div>
    <div class="row g-4">
        <?php foreach ($products as $product) : ?>
            <!-- Box Sản Phẩm -->
            <div class="col-md-3">
                <div class="product-box">
                    <img src="<?= $product['image'] ?>" alt="Product Image" class="product-img">
                    <div class="product-info">
                    <a href="<?= ROOT_URL . '?ctl=detail&id=' . htmlspecialchars($product['id']) ?>">

                            <h5 class="product-name"><?= $product['name'] ?></h5>
                        </a>
                        <div>
                            <span class="product-price">
                                <?= number_format($product['price']) ?> vnđ
                            </span>
                        </div>
                        <div class="product-buttons">

                            <button class="btn btn-outline-success">Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>

<?php include_once ROOT_DIR . "views/client/footer.php" ?>