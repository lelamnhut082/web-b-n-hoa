<?php include __DIR__ . '/../../layouts/header.php'; ?>

<div class="container" style="padding: 50px;">
    <a href="index.php?act=admin" class="back-link" style="display: block; margin-bottom: 20px; color: #3498db;">&lt; Quay lại Dashboard</a>
    <h2>Quản Lý Người Dùng</h2>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Họ Tên</th>
                    <th>Email</th>
                    <th>Vai Trò</th>
                    <th>Ngày Đăng Ký</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                <tr>
                    <td><?php echo $u['id']; ?></td>
                    <td><?php echo htmlspecialchars($u['name']); ?></td>
                    <td><?php echo htmlspecialchars($u['email']); ?></td>
                    <td>
                        <span class="badge <?php echo $u['role'] === 'admin' ? 'bg-danger' : 'bg-primary'; ?>">
                            <?php echo strtoupper($u['role']); ?>
                        </span>
                    </td>
                    <td><?php echo $u['created_at']; ?></td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($users)): ?>
                <tr><td colspan="5" class="text-center">Chưa có người dùng nào.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
</div>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>
