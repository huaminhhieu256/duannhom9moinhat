<?php include_once ROOT_DIR . "views/admin/header.php"; ?>

<div class="container mt-5">
    <h3>Danh Sách Người Dùng</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Họ Tên</th>
                <th scope="col">Email</th>
                <th scope="col">Số Điện Thoại</th>
                <th scope="col">Quyền</th>
                <th scope="col">Hoạt Động</th>
                <th scope="col">Địa Chỉ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <th scope="row"><?= $user['id'] ?></th>
                    <td><?= $user['fullname'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['phone'] ?></td>
                    <td><?= $user['role'] == 1 ? 'Admin' : 'User' ?></td>
                    <td>
                        <?php if ($user['active'] == 1) : ?>
                            <span class="badge bg-success">Hoạt động</span>
                        <?php else : ?>
                            <span class="badge bg-danger">Không hoạt động</span>
                        <?php endif; ?>
                    </td>
                    <td><?= $user['address'] ?></td>
                    <td>
                    <td>
   <form action="<?= ADMIN_URL . '?ctl=updateuser' ?>" method="POST">
       <input type="hidden" name="id" value="<?= $user['id'] ?>">
       <input type="hidden" name="active" value="<?= $user['active'] == 1 ? 0 : 1 ?>"> <!-- Truyền trạng thái active -->
       <?php if ($user['role'] != 'admin') : ?>
           <?php if ($user['active'] == 1) : ?>
               <button type="submit" class="btn btn-danger">Khóa</button>
           <?php else : ?>
               <button type="submit" class="btn btn-primary">Kích hoạt</button>
           <?php endif; ?>
       <?php endif; ?>
   </form>
</td>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php"; ?>
