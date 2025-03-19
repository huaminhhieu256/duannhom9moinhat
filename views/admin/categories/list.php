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
                <th scope="col">Tên danh mục</th>
                <th scope="col">Loại sản phẩm</th>
                <th>
                    <a href="<?= ADMIN_URL . '?ctl=adddm' ?>" class="btn btn-primary">Thêm mới</a>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $cate): ?>
                <tr>
                    <th scope="row"><?= htmlspecialchars($cate['id']) ?></th>
                    <td><?= htmlspecialchars($cate['cate_name']) ?></td>
                    <td>
                        <?php 
                        switch ($cate['type']) {
                            case 1:
                                echo 'Bánh ngọt';
                                break;
                            case 2:
                                echo 'Kem';
                                break;
                            case 3:
                                echo 'Snack';
                                break;
                                case 4:
                                    echo 'Que cay Trung Quốc';
                                    break;
                            default:
                                echo 'Không xác định';
                                break;
                        }
                        ?>
                    </td>
                    <td>
                        <a href="<?= ADMIN_URL . '?ctl=editdm&id=' . urlencode($cate['id']) ?>" class="btn btn-primary">Sửa</a>
                        <a href="<?= ADMIN_URL . '?ctl=deletedm&id=' . urlencode($cate['id']) ?>" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa không?')">Xóa</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<?php include_once ROOT_DIR . "views/admin/footer.php" ?>
