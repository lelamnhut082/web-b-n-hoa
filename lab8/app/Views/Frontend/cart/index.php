<?php include __DIR__ . '/../layouts/header.php'; ?>

<style>
    .container { max-width: 1000px; margin: 30px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
    h1 { margin-bottom: 20px; color: #333; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
    th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
    th { background-color: #f7a9a8; color: white; }
    img { width: 50px; height: 50px; object-fit: cover; }
    .btn-remove { color: red; text-decoration: none; }
    .btn-checkout { display: inline-block; padding: 10px 20px; background-color: #6da068; color: white; text-decoration: none; border-radius: 5px; }
    .total { font-weight: bold; font-size: 1.2rem; margin-bottom: 20px; text-align: right; }
</style>

<div class="container">
    <h1>Giỏ hàng của bạn</h1>
    <?php if (empty($_SESSION['cart'])): ?>
        <p>Giỏ hàng trống. <a href="index.php">Tiếp tục mua sắm</a></p>
    <?php else: ?>
        <form action="index.php?act=cart&action=update" method="POST">
            <table>
                <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total = 0;
                    foreach ($_SESSION['cart'] as $id => $item): 
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                    ?>
                        <tr>
                            <td><img src="<?php echo htmlspecialchars(get_image_path($item['img'])); ?>" alt=""></td>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td><?php echo number_format($item['price'], 0, ',', '.'); ?>đ</td>
                            <td><input type="number" name="quantity[<?php echo $id; ?>]" value="<?php echo $item['quantity']; ?>" min="1" style="width: 50px; text-align: center;"></td>
                            <td><?php echo number_format($subtotal, 0, ',', '.'); ?>đ</td>
                            <td><a href="index.php?act=cart&action=remove&id=<?php echo $id; ?>" class="btn-remove">Xóa</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <div class="total">
                Tổng cộng: <?php echo number_format($total, 0, ',', '.'); ?>đ
            </div>
            
            <div style="text-align: right;">
                <button type="submit" style="padding: 10px 20px; background-color: #3498db; color: white; border: none; cursor: pointer; border-radius: 5px;">Cập nhật giỏ hàng</button>
                <a href="index.php?act=checkout" class="btn-checkout">Thanh toán</a>
            </div>
        </form>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
