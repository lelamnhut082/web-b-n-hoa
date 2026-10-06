<?php include __DIR__ . '/../../layouts/header.php'; ?>

<div class="container" style="padding: 50px;">
    <a href="index.php?act=admin" class="back-link" style="display: block; margin-bottom: 20px; color: #3498db;">&lt; Quay lại Dashboard</a>
    <h2>Quản Lý Danh Mục</h2>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Danh Mục</th>
                    <th>Slug</th>
                    <th>Ngày Tạo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $cat): ?>
                <tr>
                    <td><?php echo $cat['id']; ?></td>
                    <td><?php echo htmlspecialchars($cat['name']); ?></td>
                    <td><?php echo htmlspecialchars($cat['slug']); ?></td>
                    <td><?php echo $cat['created_at']; ?></td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($categories)): ?>
                <tr><td colspan="4" class="text-center">Chưa có danh mục nào.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
</div>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>
