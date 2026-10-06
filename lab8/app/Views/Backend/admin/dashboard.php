<?php include __DIR__ . '/../layouts/header.php'; ?>
<div class="container" style="padding: 50px;">
    <h1>Admin Dashboard</h1>
    <p>Chào mừng admin: <strong><?php echo $_SESSION['user_name']; ?></strong></p>
    
    <div style="margin-top: 30px; display: flex; flex-wrap: wrap; gap: 20px;">
        <a href="index.php?act=admin&page=categories" style="display:inline-block; padding: 20px; background: #9b59b6; color: white; border-radius: 8px; text-decoration: none; text-align: center; width: 200px;">
            Quản lý Danh mục
        </a>
        <a href="index.php?act=admin&page=users" style="display:inline-block; padding: 20px; background: #e67e22; color: white; border-radius: 8px; text-decoration: none; text-align: center; width: 200px;">
            Quản lý Người dùng
        </a>
        <a href="index.php?act=admin&page=out_of_stock" style="display:inline-block; padding: 20px; background: #e74c3c; color: white; border-radius: 8px; text-decoration: none; text-align: center; width: 200px;">
            Sản phẩm hết hàng
        </a>
        <a href="index.php?act=admin&page=best_selling" style="display:inline-block; padding: 20px; background: #f1c40f; color: black; border-radius: 8px; text-decoration: none; text-align: center; width: 200px;">
            Sản phẩm bán chạy
        </a>
        <a href="index.php?act=admin&page=products" style="display:inline-block; padding: 20px; background: #6da068; color: white; border-radius: 8px; text-decoration: none; text-align: center; width: 200px;">
            Quản lý Sản phẩm
        </a>
        <a href="index.php?act=admin&page=orders" style="display:inline-block; padding: 20px; background: #3498db; color: white; border-radius: 8px; text-decoration: none; text-align: center; width: 200px;">
            Quản lý Đơn hàng
        </a>
    </div>
</div>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
