<?php include_once ROOT_DIR . "views/admin/header.php" ?>

<div>
    <form action="<?= ADMIN_URL . '?ctl=updatesp' ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="">Tên sản phẩm</label>
            <input type="text" name="name" value="<?= $product['name'] ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label for="">Danh mục</label>
            <select name="category_id" id="" class="form-control">
                <?php foreach ($categories as $cate): ?>
                    <option value="<?= $cate['id'] ?>"
                        <?= ($cate['id'] == $product['category_id']) ? 'selected' : '' ?>>
                        <?= $cate['cate_name'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="">Hình ảnh</label><br>
            <img src="<?= ROOT_URL . $product['image'] ?>" width="60" alt=""> <br>
            <input type="file" name="image" id="" class="form-control">
        </div>
        <div class="mb-3">
            <label for="">Giá</label>
            <input type="number" name="price" value="<?= $product['price'] ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label for="">Số lượng</label>
            <input type="number" name="quantity" value="<?= $product['quantity'] ?>" class="form-control">
        </div>

        <div class="mb-3">
            <label for="">Trạng thái</label> <br>
            <input type="radio" name="status" value="1" <?= $product['status'] == 1 ? 'checked' : '' ?> id=""> Đang kinh doanh
            <input type="radio" name="status" value="0" <?= $product['status'] == 0 ? 'checked' : '' ?> id=""> Ngừng kinh doanh
        </div>
        <div class="mb-3">
            <label for="">Mô tả sản phẩm</label>
            <textarea name="description" rows="6" class="form-control"><?= $product['description'] ?></textarea>
        </div>
        <!-- Mô tả chi tiết sản phẩm -->
        <div class="mb-3">
            <label for="">Mô tả chi tiết sản phẩm</label>
            <textarea name="detailed_description" rows="6" class="form-control"></textarea>
        </div>
        <!--Dữ liệu id-->
        <input type="hidden" name="id" value="<?= $product['id'] ?>">
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Thêm mới</button>
        </div>
    </form>
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php" ?>