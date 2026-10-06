<?php
require_once 'functions.php';
requireLogin();

$file_name = 'users.json';
$users = readJsonFile($file_name);
$action = $_GET['action'] ?? null;
$edit_user = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_data = [
        'name' => $_POST['name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'id' => (int)($_POST['id'] ?? 0),
        'password' => $_POST['password'] ?? ''
    ];

    if ($new_data['id'] > 0) {
        foreach ($users as $key => $user) {
            if ($user['id'] === $new_data['id']) {
                $users[$key]['name'] = $new_data['name'];
                $users[$key]['email'] = $new_data['email'];
                
                // Chỉ cập nhật mật khẩu nếu người dùng nhập mật khẩu mới
                if (!empty($new_data['password'])) {
                    $users[$key]['password'] = password_hash($new_data['password'], PASSWORD_DEFAULT);
                }
                break;
            }
        }
    } else {
        if (!empty($new_data['password'])) {
            $new_id = empty($users) ? 1 : max(array_column($users, 'id')) + 1;
            $new_user = [
                'id' => $new_id,
                'name' => $new_data['name'],
                'email' => $new_data['email'],
                'password' => password_hash($new_data['password'], PASSWORD_DEFAULT)
            ];
            $users[] = $new_user;
        }
    }
    
    writeJsonFile($file_name, $users);
    header('Location: admin_users.php');
    exit();
}

if ($action === 'delete' && isset($_GET['id'])) {
    $id_to_delete = (int)$_GET['id'];
    $users = array_filter($users, function($user) use ($id_to_delete) {
        return $user['id'] !== $id_to_delete;
    });
    writeJsonFile($file_name, array_values($users));
    header('Location: admin_users.php');
    exit();
}

if ($action === 'edit' && isset($_GET['id'])) {
    $id_to_edit = (int)$_GET['id'];
    foreach ($users as $user) {
        if ($user['id'] === $id_to_edit) {
            $edit_user = $user;
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Người dùng</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); }
        h1 { color: #6da068; border-bottom: 2px solid #eee; padding-bottom: 10px; margin-bottom: 20px; }
        .user-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .user-table th, .user-table td { border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 14px; }
        .user-table th { background-color: #f7a9a8; color: white; }
        .action-link { margin-right: 10px; color: #6da068; text-decoration: none; }
        .delete-link { color: #e74c3c; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 5px; }
        .form-group input { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .form-action-btn { background-color: #6da068; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; margin-top: 10px; }
        .back-link { display: block; margin-bottom: 20px; color: #3498db; }
    </style>
</head>
<body>

<div class="container">
    <a href="admin_dashboard.php" class="back-link">&lt; Quay lại Dashboard</a>
    <h1>Quản lý Người dùng</h1>

    <h3><?php echo $edit_user ? 'Sửa Người dùng: ' . htmlspecialchars($edit_user['name']) : 'Thêm Người dùng mới'; ?></h3>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $edit_user['id'] ?? 0; ?>">
        
        <div class="form-group">
            <label>Họ tên:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($edit_user['name'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($edit_user['email'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label>Mật khẩu <?php echo $edit_user ? '(Để trống nếu không muốn đổi)' : '*'; ?>:</label>
            <input type="password" name="password" placeholder="Mật khẩu mới hoặc để trống">
        </div>

        <button type="submit" class="form-action-btn"><?php echo $edit_user ? 'Cập nhật' : 'Thêm mới'; ?></button>
        <?php if ($edit_user): ?>
             <a href="admin_users.php" style="margin-left: 10px; color: #333;">Hủy</a>
        <?php endif; ?>
    </form>
    
    <hr style="margin: 40px 0;">

    <h3>Danh sách Người dùng (<?php echo count($users); ?>)</h3>
    <table class="user-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td>
                        <a href="admin_users.php?action=edit&id=<?php echo $user['id']; ?>" class="action-link">Sửa</a>
                        <a href="admin_users.php?action=delete&id=<?php echo $user['id']; ?>" class="action-link delete-link" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?');">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>