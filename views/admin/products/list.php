<?php include_once ROOT_DIR . "views/admin/header.php" ?>

<div>
    <?php if ($message != '') : ?>
        <div class="mt-3 mb-3 alert alert-success">
            <?= $message ?>
        </div>
    <?php endif ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Name</th>
                <th scope="col">Image</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Status</th>
                <th scope="col">Category</th>
                <th scope="col">Mô tả chi tiết</th> <!-- Thêm cột Mô tả chi tiết -->
                <th>
                    <a href="<?= ADMIN_URL . "?ctl=addsp" ?>" class="btn btn-primary">Create</a>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $pro) : ?>
                <tr>
                    <th scope="row"><?= $pro['id'] ?></th>
                    <td><?= $pro['name'] ?></td>
                    <td>
                        <img src="<?= ROOT_URL . $pro['image'] ?>" width="60" alt="">
                    </td>
                    <td><?= number_format($pro['price']) ?> VNĐ</td>
                    <td><?= $pro['quantity'] ?></td>
                    <td><?= $pro['status'] ? 'Đang kinh doanh' : 'Ngừng kinh doanh' ?></td>
                    <td><?= $pro['cate_name'] ?></td>
                    <td>
    <p><?= substr(empty($pro['detailed_description']) ? '' : $pro['detailed_description'], 0, 50) ?>...</p>
</td>

                    <td>
                        <a href="<?= ADMIN_URL . '?ctl=editsp&id=' . $pro['id'] ?>" class="btn btn-primary">Edit</a>
                        <a href="<?= ADMIN_URL . '?ctl=deletesp&id=' . $pro['id'] ?>" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa không?')">Xóa</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php" ?>
