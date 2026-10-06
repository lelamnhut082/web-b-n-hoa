<?php include __DIR__ . '/../../layouts/header.php'; ?>

<div class="container" style="padding: 50px;">
    <a href="index.php?act=admin" class="back-link" style="display: block; margin-bottom: 20px; color: #3498db;">&lt; Quay lại Dashboard</a>
    <h2>Sản Phẩm Bán Chạy</h2>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Xếp Hạng</th>
                    <th>ID</th>
                    <th>Hình Ảnh</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Danh Mục</th>
                    <th>Đã Bán</th>
                    <th>Tồn Kho</th>
                </tr>
            </thead>
            <tbody>
                <?php $rank = 1; foreach ($products as $p): ?>
                <tr>
                    <td><strong>#<?php echo $rank++; ?></strong></td>
                    <td><?php echo $p['id']; ?></td>
                    <td>
                        <?php if($p['img']): ?>
                            <img src="<?php echo htmlspecialchars($p['img']); ?>" alt="<?php echo htmlspecialchars($p['name']); ?>" style="width: 50px; height: 50px; object-fit: cover;">
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($p['name']); ?></td>
                    <td><?php echo htmlspecialchars($p['category_name'] ?? 'Không có'); ?></td>
                    <td><span class="badge bg-success"><?php echo $p['sold_count'] ?? 0; ?></span></td>
                    <td>
                        <?php if ($p['quantity'] <= 0): ?>
                            <span style="color:red; font-weight:bold;">Hết hàng <?php echo $p['quantity']; ?></span>
                        <?php else: ?>
                            <?php echo $p['quantity']; ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($products)): ?>
                <tr><td colspan="7" class="text-center">Chưa có dữ liệu sản phẩm bán chạy.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
</div>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>
