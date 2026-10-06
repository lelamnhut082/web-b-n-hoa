<?php include __DIR__ . '/../../layouts/header.php'; ?>
<div class="container" style="padding: 50px;">
    <h2>Quản lý Đơn hàng</h2>
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>
    
    <table class="table table-bordered table-striped mt-4">
        <thead>
            <tr>
                <th>Mã Đơn</th>
                <th>Người Đặt</th>
                <th>Tổng Tiền</th>
                <th>Ngày Đặt</th>
                <th>Trạng Thái</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
            <tr>
                <td>#<?php echo htmlspecialchars($order['id']); ?></td>
                <td><?php echo htmlspecialchars($order['user_name'] ?? 'Khách'); ?></td>
                <td><?php echo number_format($order['total_amount'], 0, ',', '.'); ?>đ</td>
                <td><?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></td>
                <td>
                    <form action="index.php?act=admin&page=orders&action=update_status&id=<?php echo $order['id']; ?>" method="POST" class="d-flex align-items-center gap-2">
                        <select name="status" class="form-select form-select-sm" style="width: auto;">
                            <option value="pending" <?php echo $order['status'] === 'pending' ? 'selected' : ''; ?>>Chờ xử lý (pending)</option>
                            <option value="processing" <?php echo $order['status'] === 'processing' ? 'selected' : ''; ?>>Đang xử lý (processing)</option>
                            <option value="shipped" <?php echo $order['status'] === 'shipped' ? 'selected' : ''; ?>>Đang giao (shipped)</option>
                            <option value="completed" <?php echo $order['status'] === 'completed' ? 'selected' : ''; ?>>Hoàn thành (completed)</option>
                            <option value="cancelled" <?php echo $order['status'] === 'cancelled' ? 'selected' : ''; ?>>Đã hủy (cancelled)</option>
                        </select>
                        <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($orders)): ?>
                <tr>
                    <td colspan="5" class="text-center">Chưa có đơn hàng nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
    <a href="index.php?act=admin" class="btn btn-secondary mt-3">Quay Lại Dashboard</a>
</div>
<?php include __DIR__ . '/../../layouts/footer.php'; ?>
