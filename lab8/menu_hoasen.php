<?php
// Tên file JSON cần đọc
$file_path = 'products.json';
if (!file_exists($file_path)) {
    die("Lỗi: Không tìm thấy file JSON tại đường dẫn: " . $file_path);
}
$json_data = file_get_contents($file_path);
if ($json_data === false) {
    die("Lỗi: Không thể đọc nội dung file JSON.");
}
$products = json_decode($json_data, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    die("Lỗi giải mã JSON: " . json_last_error_msg());
}



function renderProductsByCategory(array $products, string $category_slug) {
    $detail_page = 'chi_tiet_san_pham.php';
    $count = 0;
    echo '<section class="product-category-section">';
    echo '<div class="product-list-container">';
    foreach ($products as $product) {
        if (isset($product['category']) && $product['category'] === $category_slug) {
            $count++;
            $product_id = htmlspecialchars($product['id']);
            $product_link = $detail_page . '?id=' . $product_id;

            echo '<div class="product-card">';
            if (isset($product['img'])) {
                echo '<a href="' . $product_link . '">';
                echo '<img src="' . htmlspecialchars($product['img']) . '" alt="' . htmlspecialchars($product['name'] ?? 'Sản phẩm hoa') . '">';
                echo '</a>';
            }
            if (isset($product['name'])) {
                echo '<h3><a href="' . $product_link . '">' . htmlspecialchars($product['name']) . '</a></h3>';
            }
            if (isset($product['price'])) {
                echo '<p class="product-price">' . htmlspecialchars($product['price']) . '</p>';
            }
            echo '<a href="' . $product_link . '" class="btn-add-to-cart" data-product-id="' . $product['id'] . '" style="text-decoration: none;">Xem chi tiết</a>';
            
            echo '</div>'; 
        }
    }
    echo '</div>'; 
    if ($count === 0) {
        echo "<p>Hiện tại chưa có sản phẩm nào thuộc danh mục.</p>";
    }
    echo '</section>'; 
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoa đồng tiền</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header> 
        <?php include 'layout/header.php'; ?>
    </header>

 <div class="container">
        <div class="col">
            <div class="title" style="display: flex; align-items: center; justify-content: space-between; width: 100%; padding: 1rem 2rem;"><span class="" style="font-size: 1.5rem; color: #333;">HOA TƯƠI NỔI BẬT</span> <a href="" style="text-decoration: none; font-size: 1rem; color: #333;">Xem thêm &gt;</a></div>
            <div class="row">
                <?php
                    renderProductsByCategory(
                        $products, 
                        'hop_hoa_doc_dao', 
                    ); 
                ?>
            </div>
        </div>
</div>

    <?php include 'layout/footer.php'; ?>

</body>
</html>
