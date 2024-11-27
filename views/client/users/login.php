<?php include_once ROOT_DIR . "views/client/header.php" ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h3 class="text-center">Đăng Nhập</h3>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <form action="<?= ROOT_URL ?>?ctl=login" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Tên đăng nhập hoặc Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Đăng Nhập</button>
            </form>

            <p class="text-center mt-3">Chưa có tài khoản? <a href="<?= ROOT_URL ?>?ctl=register">Đăng ký</a></p>
        </div>
    </div>
</div>

<?php include_once ROOT_DIR . "views/client/footer.php" ?>
