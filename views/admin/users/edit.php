<?php include_once ROOT_DIR . "views/admin/header.php"; ?>

<div class="container mt-5">
    <h3>Chỉnh Sửa Quyền Người Dùng</h3>
    <form action="<?= ADMIN_URL . '?ctl=updateuser' ?>" method="POST">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        
        <!-- Họ Tên -->
        <div class="mb-3">
            <label for="fullname" class="form-label">Họ Tên</label>
            <input type="text" class="form-control" id="fullname" value="<?= $user['fullname'] ?>" disabled>
        </div>
        
        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" value="<?= $user['email'] ?>" disabled>
        </div>
        
        <!-- Số Điện Thoại -->
        <div class="mb-3">
            <label for="phone" class="form-label">Số Điện Thoại</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?= $user['phone'] ?>" required>
        </div>
        
        <!-- Quyền -->
        <div class="mb-3">
            <label for="role" class="form-label">Quyền</label>
            <select class="form-select" name="role" required>
                <option value="0" <?= $user['role'] == 0 ? 'selected' : '' ?>>User</option>
                <option value="1" <?= $user['role'] == 1 ? 'selected' : '' ?>>Admin</option>
            </select>
        </div>
        
        <!-- Hoạt động -->
        <div class="mb-3">
            <label for="active" class="form-label">Trạng Thái Hoạt Động</label>
            <select class="form-select" name="active" required>
                <option value="1" <?= $user['active'] == 1 ? 'selected' : '' ?>>Hoạt động</option>
                <option value="0" <?= $user['active'] == 0 ? 'selected' : '' ?>>Không hoạt động</option>
            </select>
        </div>
        
        <!-- Địa chỉ -->
        <div class="mb-3">
            <label for="address" class="form-label">Địa Chỉ</label>
            <input type="text" class="form-control" id="address" name="address" value="<?= $user['address'] ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Cập Nhật</button>
    </form>
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php"; ?>
