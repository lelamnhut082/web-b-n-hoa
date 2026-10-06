<?php
require_once 'functions.php';
requireLogin();

$user_name = $_SESSION['user_name'] ?? 'Admin';

$logout_link = 'process_auth.php?action=logout';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; padding: 20px; }
        .dashboard-container { max-width: 1000px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); }
        .dashboard-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #6da068; padding-bottom: 10px; margin-bottom: 30px; }
        .dashboard-header h1 { color: #6da068; margin: 0; }
        .menu a { text-decoration: none; color: white; background-color: #f7a9a8; padding: 10px 15px; border-radius: 4px; margin-right: 10px; display: inline-block; }
        .menu a:hover { background-color: #e9596c; }
        .logout-btn { color: #e74c3c; text-decoration: none; margin-left: 20px; }
    </style>
</head>
<body>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>Xin chào, <?php echo htmlspecialchars($user_name); ?>!</h1>
        <a href="<?php echo $logout_link; ?>" class="logout-btn">Đăng Xuất</a>
    </div>

    <h2>Quản Lý Hệ Thống flowerCorner</h2>

    <div class="menu">
        <a href="admin_products.php">Quản lý Sản phẩm</a>
        <a href="admin_users.php">Quản lý Người dùng</a>
    </div>
    
    <p style="margin-top: 40px; color: #666;">Chọn một danh mục để bắt đầu quản lý.</p>
</div>

</body>
</html>