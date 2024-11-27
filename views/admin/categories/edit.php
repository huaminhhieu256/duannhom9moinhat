<?php include_once ROOT_DIR . "views/admin/header.php" ?>
<div>
    <?php if ($message != '') : ?>
        <div class="mt-3 mb-3 alert alert-success">
            <?= $message ?>
        </div>
    <?php endif ?>
    <form class="mt-3" action="<?= ADMIN_URL . '?ctl=updatedm' ?>" method="post">
        <div class="mb-3">
            <label for="">Tên danh mục</label>
            <input type="text" name="cate_name" value="<?= htmlspecialchars($category['cate_name']) ?>" class="form-control">
        </div>

        <div class="mb-3">
            <label for="">Loại sản phẩm</label> <br>
            <input type="radio" name="type" value="1" <?= $category['type'] == 1 ? 'checked' : '' ?>> Bánh ngọt <br>
            <input type="radio" name="type" value="2" <?= $category['type'] == 2 ? 'checked' : '' ?>> Kem <br>
            <input type="radio" name="type" value="3" <?= $category['type'] == 3 ? 'checked' : '' ?>> Snack
        </div>

        <input type="hidden" name="id" value="<?= htmlspecialchars($category['id']) ?>">

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </div>
    </form>
</div>
<?php include_once ROOT_DIR . "views/admin/footer.php" ?>
