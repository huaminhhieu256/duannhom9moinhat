
<?php include_once ROOT_DIR . "views/admin/header.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng - Admin</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h4>Chi tiết đơn hàng</h4>
            </div>
            <div class="card-body">
                <!-- Thông báo nếu có -->
                <?php if (isset($message)): ?>
                    <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
                <?php endif; ?>

                <!-- Thông tin đơn hàng -->
                <div class="mb-4">
                    <h5>Mã đơn hàng: #<?= htmlspecialchars($order['id']) ?></h5>
                    <p><strong>Ngày đặt hàng:</strong> <?= date('d-m-Y H:i:s', strtotime($order['created_at'])) ?></p>
                </div>

                <!-- Thông tin khách hàng -->
                <div class="mb-4">
                    <h5>Thông tin khách hàng</h5>
                    <p><strong>Họ tên:</strong> <?= htmlspecialchars($order['fullname']) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($order['email']) ?></p>
                    <p><strong>Điện thoại:</strong> <?= htmlspecialchars($order['phone']) ?></p>
                    <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($order['address']) ?></p>
                </div>

                <!-- Danh sách sản phẩm -->
                <div class="mb-4">
                    <h5>Danh sách sản phẩm</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sản phẩm</th>
                                <th>Ảnh sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($order_details as $index => $detail): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= htmlspecialchars($detail['product_name']) ?></td>
                                    <td>
                                        <img src="<?= ROOT_URL . htmlspecialchars($detail['image']) ?>" alt="" width="120">
                                    </td>
                                    <td><?= htmlspecialchars($detail['quantity']) ?></td>
                                    <td><?= number_format($detail['price']) ?> VNĐ</td>
                                    <td><?= number_format($detail['price'] * $detail['quantity']) ?> VNĐ</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-end">Tổng cộng:</th>
                                <th><?= number_format($order['total_price']) ?> VNĐ</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Cập nhật trạng thái đơn hàng -->
                <div class="mb-4">
                    <h5>Cập nhật trạng thái đơn hàng</h5>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="orderStatus" class="form-label">Trạng thái đơn hàng</label>
                            <select id="orderStatus" name="status" class="form-select">
                                <?php foreach ($status as $key => $value): ?>
                                    <option value="<?= $key ?>" <?= $order['status'] == $key ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($value) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>

                <!-- Nút thao tác -->
                <div class="d-flex justify-content-between">
                    <a href="/admin/orders" class="btn btn-secondary">Quay lại danh sách đơn hàng</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Link Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
