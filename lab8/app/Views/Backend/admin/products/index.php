<?php include __DIR__ . '/../../layouts/header.php'; ?>
<style>
    .admin-container { max-width: 1200px; margin: 30px auto; padding: 20px; background: white; }
    .btn-primary { background: #6da068; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px; }
    .btn-danger { background: #e74c3c; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    th { background: #f4f4f4; }
    .form-box { background: #f9f9f9; padding: 20px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #ddd; }
    .form-group { margin-bottom: 10px; }
    .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
    .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
</style>

<div class="admin-container">
    <h1>Quản lý Sản phẩm</h1>
    <a href="index.php?act=admin" style="font-size: 0.9rem;">&lt; Quay lại Dashboard</a>
    
    <?php if (isset($_SESSION['success'])): ?>
        <p style="color: green;"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
    <?php endif; ?>

    <div class="form-box">
        <h3><?php echo $editProduct ? 'Cập nhật sản phẩm' : 'Thêm sản phẩm mới'; ?></h3>
        <form action="index.php?act=admin&page=products&action=store" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $editProduct['id'] ?? ''; ?>">
            <input type="hidden" name="existing_img" value="<?php echo $editProduct['img'] ?? ''; ?>">
            
            <div class="form-group">
                <label>Tên sản phẩm</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($editProduct['name'] ?? ''); ?>" required>
            </div>
            
            <div class="form-group">
                <label>Giá</label>
                <input type="number" name="price" value="<?php echo htmlspecialchars($editProduct['price'] ?? ''); ?>" required>
            </div>
            
            <div class="form-group">
                <label>Tồn kho</label>
                <input type="number" name="quantity" value="<?php echo htmlspecialchars($editProduct['quantity'] ?? 0); ?>" required>
            </div>
            
            <div class="form-group">
                <label>Danh mục</label>
                <select name="category_id" required>
                    <option value="">-- Chọn danh mục --</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>" <?php echo (isset($editProduct['category_id']) && $editProduct['category_id'] == $cat['id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cat['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label>Hình ảnh</label>
                <?php if (!empty($editProduct['img'])): ?>
                    <img src="<?php echo htmlspecialchars($editProduct['img']); ?>" width="50" style="margin-bottom: 5px;">
                <?php endif; ?>
                <input type="file" name="img" accept="image/*">
            </div>
            
            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="description" rows="3"><?php echo htmlspecialchars($editProduct['description'] ?? ''); ?></textarea>
            </div>
            
            <button type="submit" class="btn-primary"><?php echo $editProduct ? 'Cập nhật' : 'Thêm mới'; ?></button>
            <?php if ($editProduct): ?>
                <a href="index.php?act=admin&page=products" class="btn-danger" style="background:#7f8c8d;">Hủy</a>
            <?php endif; ?>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Ảnh</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>Tồn kho</th>
                <th>Danh mục</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $p): ?>
            <tr>
                <td><?php echo $p['id']; ?></td>
                    <td><img src="<?php echo htmlspecialchars(get_image_path($p['img'])); ?>" width="50"></td>
                <td><?php echo htmlspecialchars($p['name']); ?></td>
                <td><?php echo number_format($p['price'], 0, ',', '.'); ?>đ</td>
                <td>
                    <?php if ($p['quantity'] <= 0): ?>
                        <span style="color:red; font-weight:bold;">Hết hàng</span>
                    <?php else: ?>
                        <?php echo $p['quantity']; ?>
                    <?php endif; ?>
                </td>
                <td><?php echo htmlspecialchars($p['category_name'] ?? 'N/A'); ?></td>
                <td>
                    <a href="index.php?act=admin&page=products&action=edit&id=<?php echo $p['id']; ?>" class="btn-primary">Sửa</a>
                    <a href="index.php?act=admin&page=products&action=delete&id=<?php echo $p['id']; ?>" class="btn-danger" onclick="return confirm('Xóa?')">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>
