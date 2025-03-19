<?php include_once ROOT_DIR . "views/client/header.php" ?>

<div class="container mt-5">
    <div class="row">
        <!-- Hình ảnh sản phẩm -->
        <div class="col-md-6">
            <img src="<?= $product['image'] ?>" alt="Tên sản phẩm" class="img-fluid rounded">
        </div>
        <!-- Thông tin sản phẩm -->
        <div class="col-md-6">
            <h1 class="display-5"><?= $product['name'] ?></h1>
            <p class="text-muted">Trạng thái:
                <?php if ($product['quantity'] > 0) : ?>
                    <span class="badge bg-success">Còn hàng</span>
                <?php else : ?>
                    <span class="badge bg-danger">Hết hàng</span>
                <?php endif ?>
            </p>
            <h3 class="text-danger">Giá: <?= number_format($product['price']) ?> VNĐ</h3>
            <p><strong>Số lượng còn:</strong> <?= $product['quantity'] ?></p>
            <p class="mt-4">
                <strong>Mô tả sản phẩm:</strong><br>
                <?= $product['description'] ?>
            </p>
            <!-- Nút thêm vào giỏ hàng -->
            <div class="mt-4">
                <a href="<?= ROOT_URL . '?ctl=add-cart&id=' . $product['id'] ?>" class="btn btn-primary btn-lg">
                    <i class="bi bi-cart-plus"></i> Thêm vào giỏ hàng
                </a>
            </div>
        </div>
    </div>

    <!-- Mô tả chi tiết sản phẩm -->
    <div class="row mt-5">
        <div class="col">
            <h2>Mô tả chi tiết</h2>
            <p>
                <?= $product['detailed_description'] ?? 'Mô tả chi tiết chưa có.' ?>
            </p>
        </div>
    </div>

    <div class="mt-5">
        <hr>
        <h3>Bình luận</h3>
        <div class="comment-list mt-4">
    <?php foreach ($comments as $comment): ?>
        <div class="mb-3 p-3 rounded shadow-sm bg-light">
            <p class="fw-bold mb-1"><?= htmlspecialchars($comment['fullname']) ?>
                <small class="text-muted"><?= date('d-m-Y H:i:s', strtotime($comment['created_at'])) ?></small>
            </p>
            <p class="mb-0"><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
        </div>
    <?php endforeach ?>
</div>
        <!-- Form bình luận -->
        <?php if (isset($_SESSION['user'])): ?>
            <form action="" method="POST" class="mt-4">
                <div class="form-floating mb-3">
                    <textarea name="content" class="form-control" placeholder="Viết bình luận của bạn" id="commentContent" style="height: 100px" required></textarea>
                    <label for="commentContent">Viết bình luận của bạn...</label>
                </div>
                <button type="submit" class="btn btn-primary">Gửi</button>
            </form>
        <?php else: ?>
            <div class="alert alert-warning mt-4">
                Bạn cần <b><a href="<?= ROOT_URL . '?ctl=login' ?>">đăng nhập</a></b> để bình luận.
            </div>
        <?php endif ?>
    </div>
</div>

<?php include_once ROOT_DIR . "views/client/footer.php" ?>
