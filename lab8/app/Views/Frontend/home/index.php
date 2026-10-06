<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="banner">
    <img src="img/backrou.webp" alt="">
</div>

<div class="container">
    <?php
    $categories_to_show = [
        ['slug' => 'bo_hoa_tinh_te', 'title' => 'HOA TƯƠI NỔI BẬT'],
        ['slug' => 'gio_hoa_sang_trong', 'title' => 'HOA CHO NGÀY TRỌNG ĐẠI'],
        ['slug' => 'hop_hoa_doc_dao', 'title' => 'HOA NGÀY 20 THÁNG 10']
    ];

    foreach ($categories_to_show as $cat_info) {
        $cat_slug = $cat_info['slug'];
        $cat_title = $cat_info['title'];
        
        $cat_products = array_filter($products, function($p) use ($cat_slug) {
            return isset($p['category_slug']) && $p['category_slug'] === $cat_slug;
        });
        
       
        ?>
        <div class="col">
            <div class="title" style="display: flex; align-items: center; justify-content: space-between; width: 100%; padding: 1rem 2rem;">
                <span class="" style="font-size: 1.5rem; color: #333;"><?= htmlspecialchars($cat_title) ?></span> 
                <a href="" style="text-decoration: none; font-size: 1rem; color: #333;">Xem thêm &gt;</a>
            </div>
            <div class="row">
                <section class="product-category-section">
                    <div class="product-list-container">
                        <?php if (empty($cat_products)): ?>
                             <p>Hiện tại chưa có sản phẩm nào thuộc danh mục.</p>
                        <?php else: ?>
                            <?php foreach ($cat_products as $product): ?>
                                <?php 
                                    $link = 'index.php?act=detail&id=' . $product['id'];
                                    // Handle image path - check if it's full path or relative
                                    $img = $product['img']; 
                                ?>
                                <div class="product-card">
                                    <a href="<?= $link ?>">
                                        <img src="<?= htmlspecialchars(get_image_path($product['img'])) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                                    </a>
                                    <h3><a href="<?= $link ?>"><?= htmlspecialchars($product['name']) ?></a></h3>
                                    <p class="product-price" style="margin-bottom: 5px;"><?= number_format($product['price'], 0, ',', '.') ?>đ</p>
                                    <p style="margin-bottom: 15px; font-size: 0.9em; color: <?= ($product['quantity'] <= 0) ? 'red' : '#555' ?>;">
                                        Tồn kho: <?= ($product['quantity'] <= 0) ? 'Hết hàng' : $product['quantity'] ?>
                                    </p>
                                    <?php if ($product['quantity'] > 0): ?>
                                        <a href="<?= $link ?>" class="btn-add-to-cart">Xem chi tiết</a>
                                    <?php else: ?>
                                        <a href="<?= $link ?>" class="btn-add-to-cart" style="background-color: #ccc; cursor: not-allowed; pointer-events: none;">Tạm hết hàng</a>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </section>
            </div>
        </div>
        <?php
    }
    ?>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
