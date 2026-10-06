<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container" style="max-width: 600px; margin: 50px auto; padding: 20px; background: white; border-radius: 8px;">
    <h1>Thanh toán</h1>
    <p>Xác nhận đơn hàng của bạn.</p>
    
    <table style="width: 100%; margin-bottom: 20px;">
        <?php 
        $total = 0;
        foreach ($_SESSION['cart'] as $item): 
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
        ?>
            <tr>
                <td><?php echo htmlspecialchars($item['name']); ?> x <?php echo $item['quantity']; ?></td>
                <td style="text-align: right;"><?php echo number_format($subtotal, 0, ',', '.'); ?>đ</td>
            </tr>
        <?php endforeach; ?>
        <tr style="font-weight: bold; border-top: 2px solid #ddd;">
            <td>Tổng cộng</td>
            <td style="text-align: right;"><?php echo number_format($total, 0, ',', '.'); ?>đ</td>
        </tr>
    </table>

    <form action="index.php?act=checkout" method="POST">
        <div class="form-group">
            <label>Địa chỉ giao hàng (Tạm thời dùng địa chỉ mặc định):</label>
            <textarea name="address" style="width: 100%; padding: 10px;" required placeholder="Nhập địa chỉ giao hàng..."></textarea>
        </div>
        <button type="submit" style="width: 100%; padding: 15px; background: #6da068; color: white; border: none; font-size: 16px; cursor: pointer; margin-top: 10px;">XÁC NHẬN ĐẶT HÀNG</button>
    </form>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
