<?php include __DIR__ . '/../layouts/header.php'; ?>

<style>
    .container { max-width: 1000px; margin: 50px auto; padding: 0 15px; }
    .product-detail { display: flex; gap: 40px; }
    .product-detail .left { flex: 1; }
    .product-detail .right { flex: 1; }
    .product-detail img { width: 100%; height: auto; border-radius: 8px; }
    .product-detail h1 { font-size: 32px; color: #333; margin-top: 0; }
    .product-detail .price { font-size: 24px; color: #e9596c; margin-bottom: 20px; }
    .description { border-top: 3px solid #373737; padding-top: 10px; font-size: 16px; color: #333; margin-bottom: 30px; }
    .info-section h3 { font-size: 18px; color: #6da068; border-bottom: 3px solid #373737; padding-bottom: 5px; margin-top: 20px; }
    .info-section { font-size: 16px; color: #333; }
    .order-btn { display: block; width: 100%; text-align: center; background-color: #f7a9a8; color: white; padding: 15px; text-decoration: none; font-weight: bold; border-radius: 5px; margin-top: 10px; transition: background-color 0.3s; }
    .order-btn:hover { background-color: #e9596c; }
    @media (max-width: 768px) { .product-detail { flex-direction: column; } }
</style>

<div class="container">
    <div class="product-detail">
        <div class="left">
            <img src="<?php echo htmlspecialchars(get_image_path($product['img'] ?? '')); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
        </div>
        <div class="right">
            <h1><?php echo htmlspecialchars($product['name']); ?></h1>
            <p class="price" style="margin-bottom: 10px;">
                <?php echo number_format($product['price'], 0, ',', '.'); ?>đ
            </p>
            <p style="font-size: 16px; margin-bottom: 20px; font-weight: bold; color: <?= ($product['quantity'] <= 0) ? 'red' : '#6da068' ?>;">
                Trạng thái: <?= ($product['quantity'] <= 0) ? 'Hết hàng' : 'Còn hàng (' . $product['quantity'] . ')' ?>
            </p>
            <div class="description">
                <?php echo htmlspecialchars($product['description'] ?? 'Mô tả đang cập nhật...'); ?>
            </div>
            
            <?php if ($product['quantity'] > 0): ?>
                <a href="index.php?act=cart&action=add&id=<?php echo $product['id']; ?>" class="order-btn">ĐẶT HOA NGAY</a>
            <?php else: ?>
                <a href="#" class="order-btn" style="background-color: #ccc; cursor: not-allowed;">SẢN PHẨM HẾT HÀNG</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
