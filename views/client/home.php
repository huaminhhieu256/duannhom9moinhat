<?php include_once ROOT_DIR . "views/client/header.php" ?>

<div class="container mt-5">
    <!-- Hiển thị các sản phẩm Bánh ngọt -->
    <h1>Bánh ngọt</h1>
    <div class="row g-4">
        <?php foreach ($cakes as $product) : ?>
            <!-- Box Sản Phẩm -->
            <div class="col-md-3">
                <div class="product-box">
                    <img src="<?= $product['image'] ?>" alt="Product Image" class="product-img">
                    <div class="product-info">
                        <a href="<?= ROOT_URL . '?ctl=detail&id=' . $product['id'] ?>">
                            <h5 class="product-name"><?= $product['name'] ?></h5>
                        </a>
                        <div>
                            <span class="product-price">
                                <?= number_format($product['price']) ?> vnđ
                            </span>
                        </div>
                        <div class="product-buttons">
    <a href="<?= ROOT_URL . '?ctl=add-cart&id=' . $product['id'] ?>" class="btn btn-outline-success">
        Thêm vào giỏ hàng
    </a>
</div>

                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>

    <!-- Hiển thị các sản phẩm Kem -->
    <h1 class="mt-5">Kem</h1>
    <div class="row g-4">
        <?php foreach ($ice_creams as $product) : ?>
            <!-- Box Sản Phẩm -->
            <div class="col-md-3">
                <div class="product-box">
                    <img src="<?= $product['image'] ?>" alt="Product Image" class="product-img">
                    <div class="product-info">
                        <a href="<?= ROOT_URL . '?ctl=detail&id=' . $product['id'] ?>">
                            <h5 class="product-name"><?= $product['name'] ?></h5>
                        </a>
                        <div>
                            <span class="product-price">
                                <?= number_format($product['price']) ?> vnđ
                            </span>
                        </div>
                        <div class="product-buttons">
    <a href="<?= ROOT_URL . '?ctl=add-cart&id=' . $product['id'] ?>" class="btn btn-outline-success">
        Thêm vào giỏ hàng
    </a>
</div>

                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>

    <!-- Hiển thị các sản phẩm Snack -->
    <h1 class="mt-5">Snack</h1>
    <div class="row g-4">
        <?php foreach ($snacks as $product) : ?>
            <!-- Box Sản Phẩm -->
            <div class="col-md-3">
                <div class="product-box">
                    <img src="<?= $product['image'] ?>" alt="Product Image" class="product-img">
                    <div class="product-info">
                        <a href="<?= ROOT_URL . '?ctl=detail&id=' . $product['id'] ?>">
                            <h5 class="product-name"><?= $product['name'] ?></h5>
                        </a>
                        <div>
                            <span class="product-price">
                                <?= number_format($product['price']) ?> vnđ
                            </span>
                        </div>
                        <div class="product-buttons">
    <a href="<?= ROOT_URL . '?ctl=add-cart&id=' . $product['id'] ?>" class="btn btn-outline-success">
        Thêm vào giỏ hàng
    </a>
</div>

                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>

   

<?php include_once ROOT_DIR . "views/client/footer.php" ?>
