<?php
require_once 'functions.php';
requireLogin();

$file_name = 'products.json';
$products = readJsonFile($file_name);
$action = $_GET['action'] ?? null;
$edit_product = null;
$message = '';
$upload_dir = 'uploads/'; 

if (isset($_GET['msg'])) {
    $message = htmlspecialchars($_GET['msg']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Khởi tạo dữ liệu cơ bản từ POST
    $new_data = [
        'name' => $_POST['name'] ?? '',
        'price' => $_POST['price'] ?? '',
        'img' => $_POST['existing_img'] ?? '', // Giữ lại ảnh cũ
        'link' => $_POST['link'] ?? '',
        'category' => $_POST['category'] ?? '',
        'id' => (int)($_POST['id'] ?? 0)
    ];

    $is_upload_ok = true; 
    $uploaded_file_path = $new_data['img']; 
    
    // Đảm bảo thư mục uploads tồn tại
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
        $file_tmp_name = $_FILES['product_image']['tmp_name'];
        $file_name_original = basename($_FILES['product_image']['name']);
        
        $file_extension = pathinfo($file_name_original, PATHINFO_EXTENSION);
        $new_file_name = uniqid('prod_', true) . '.' . $file_extension;
        $target_file = $upload_dir . $new_file_name;

        if (move_uploaded_file($file_tmp_name, $target_file)) {
            $uploaded_file_path = $target_file; 
        } else {
            $is_upload_ok = false;
            $message = "Lỗi khi di chuyển file ảnh. Kiểm tra quyền ghi thư mục 'uploads/'.";
        }
    }
    
    $new_data['img'] = $uploaded_file_path; 

    if ($is_upload_ok) {
        if ($new_data['id'] > 0) {
            foreach ($products as $key => $product) {
                if ($product['id'] === $new_data['id']) {
                    $products[$key] = $new_data;
                    $message = "Cập nhật sản phẩm thành công!";
                    break;
                }
            }
        } else {
            $new_id = empty($products) ? 1 : max(array_column($products, 'id')) + 1;
            $new_data['id'] = $new_id;
            $products[] = $new_data;
            $message = "Thêm sản phẩm mới thành công!";
        }
        
        writeJsonFile($file_name, $products);
        header('Location: admin_products.php?msg=' . urlencode($message));
        exit();
    }
    
    $edit_product = $new_data;
}

// --- LOGIC XÓA SẢN PHẨM (GET) ---
if ($action === 'delete' && isset($_GET['id'])) {
    $id_to_delete = (int)$_GET['id'];
    $products = array_filter($products, function($product) use ($id_to_delete) {
        return $product['id'] !== $id_to_delete;
    });

    writeJsonFile($file_name, array_values($products)); 
    $message = "Xóa sản phẩm thành công!";
    header('Location: admin_products.php?msg=' . urlencode($message));
    exit();
}

if ($action === 'edit' && isset($_GET['id'])) {
    $id_to_edit = (int)$_GET['id'];
    foreach ($products as $product) {
        if ($product['id'] === $id_to_edit) {
            $edit_product = $product;
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Sản phẩm</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); }
        h1 { color: #6da068; border-bottom: 2px solid #eee; padding-bottom: 10px; margin-bottom: 20px; }
        .product-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .product-table th, .product-table td { border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 14px; }
        .product-table th { background-color: #f7a9a8; color: white; }
        .action-link { margin-right: 10px; color: #6da068; text-decoration: none; }
        .delete-link { color: #e74c3c; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 5px; }
        .form-group input, .form-group select { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .form-group input[type="file"] { border: none; padding: 0; }
        .form-action-btn { background-color: #6da068; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; margin-top: 10px; }
        .back-link { display: block; margin-bottom: 20px; color: #3498db; }
        .current-img { max-width: 80px; height: auto; margin-bottom: 5px; border: 1px solid #eee; }
        .success-msg { color: green; font-weight: bold; }
        .error-msg { color: red; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <a href="admin_dashboard.php" class="back-link">&lt; Quay lại Dashboard</a>
    <h1>Quản lý Sản phẩm</h1>
    
    <?php if (!empty($message)): ?>
        <p class="<?php echo strpos($message, 'Lỗi') !== false ? 'error-msg' : 'success-msg'; ?>"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <h3><?php echo $edit_product ? 'Sửa Sản phẩm: ' . htmlspecialchars($edit_product['name']) : 'Thêm Sản phẩm mới'; ?></h3>
    <form method="POST" enctype="multipart/form-data"> 
        <input type="hidden" name="id" value="<?php echo $edit_product['id'] ?? 0; ?>">
        
        <div class="form-group">
            <label>Tên sản phẩm:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($edit_product['name'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label>Giá:</label>
            <input type="text" name="price" value="<?php echo htmlspecialchars($edit_product['price'] ?? ''); ?>" required>
        </div>
        
        <div class="form-group">
            <label>Ảnh sản phẩm:</label>
            <?php if (isset($edit_product['img']) && $edit_product['img']): ?>
                <img src="<?php echo htmlspecialchars($edit_product['img']); ?>" alt="Ảnh hiện tại" class="current-img">
                <input type="hidden" name="existing_img" value="<?php echo htmlspecialchars($edit_product['img']); ?>">
            <?php endif; ?>
            
            <label style="font-weight: normal;">Tải ảnh mới:</label>
            <input type="file" name="product_image" accept="image/*">
        </div>
        
        <div class="form-group">
            <label>Danh mục (category):</label>
            <input type="text" name="category" value="<?php echo htmlspecialchars($edit_product['category'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label>Link chi tiết (link):</label>
            <input type="text" name="link" value="<?php echo htmlspecialchars($edit_product['link'] ?? ''); ?>" placeholder="Ví dụ: sp1.php">
        </div>

        <button type="submit" class="form-action-btn"><?php echo $edit_product ? 'Cập nhật' : 'Thêm mới'; ?></button>
        <?php if ($edit_product): ?>
             <a href="admin_products.php" style="margin-left: 10px; color: #333;">Hủy</a>
        <?php endif; ?>
    </form>
    
    <hr style="margin: 40px 0;">

    <h3>Danh sách Sản phẩm (<?php echo count($products); ?>)</h3>
    <table class="product-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Danh mục</th>
                <th>Ảnh</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['id']); ?></td>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td><?php echo htmlspecialchars($product['price']); ?></td>
                    <td><?php echo htmlspecialchars($product['category']); ?></td>
                    <td>
                        <?php if ($product['img']): ?>
                            <img src="<?php echo htmlspecialchars($product['img']); ?>" alt="Ảnh" style="width: 50px; height: 50px; object-fit: cover;">
                        <?php else: ?>
                            Không có ảnh
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="admin_products.php?action=edit&id=<?php echo $product['id']; ?>" class="action-link">Sửa</a>
                        <a href="admin_products.php?action=delete&id=<?php echo $product['id']; ?>" class="action-link delete-link" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>