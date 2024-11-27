<?php include_once ROOT_DIR . "views/client/header.php" ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h3 class="text-center">Đăng Nhập</h3>
            <form action="<?= ROOT_URL ?>?ctl=login" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Tên đăng nhập hoặc Email</label>
                    <input type="text" class="form-control" id="username" name="username" required>
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
