<?php
// BẮT BUỘC: Khởi động Session để quản lý giỏ hàng
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// --- 1. HÀM ĐỌC DỮ LIỆU GỐC TỪ JSON ---

/**
 * Đọc toàn bộ sản phẩm từ file products.json
 * @return array Mảng chứa tất cả sản phẩm, hoặc mảng rỗng nếu lỗi.
 */
function getProductsFromJson() {
    $file_path = 'products.json';
    if (!file_exists($file_path)) {
        // Có thể thêm log lỗi ở đây
        return []; 
    }
    $json_data = file_get_contents($file_path);
    // Trả về mảng kết hợp
    return json_decode($json_data, true) ?: []; 
}

// --- 2. KHỞI TẠO VÀ XỬ LÝ DỮ LIỆU ---

$all_products = getProductsFromJson();
// Lấy giỏ hàng từ Session, nếu chưa có thì là mảng rỗng
$cart = $_SESSION['cart'] ?? []; 

$total_price_vnd = 0; 
$cart_details = []; // Mảng chứa chi tiết sản phẩm để hiển thị (bao gồm tên, giá, số lượng)

// Lọc và chuyển đổi mảng sản phẩm gốc thành mảng dễ tìm kiếm hơn (dùng ID làm key)
$products_by_id = [];
foreach ($all_products as $p) {
    if (isset($p['id'])) {
        $products_by_id[$p['id']] = $p;
    }
}

// --- 3. TÍNH TOÁN GIỎ HÀNG ---

foreach ($cart as $item_id => $item) {
    $product_id = $item['id'];
    $quantity = $item['qty'];

    // Tìm thông tin sản phẩm đầy đủ từ mảng đã được chuyển đổi
    $product_info = $products_by_id[$product_id] ?? null;

    if ($product_info) {
        // Lấy giá và loại bỏ các ký tự không phải số/chữ số để tính toán
        $price_string = preg_replace('/[^\d]/', '', $product_info['price']);
        
        // Chuyển đổi giá thành dạng số nguyên (chia 1000 nếu bạn dùng format 490.000đ và muốn bỏ dấu chấm)
        // Lưu ý: Giá trị trong JSON của bạn là 490.000đ, ta cần cẩn thận khi chuyển đổi
        $unit_price = (int)str_replace('.', '', $price_string); // Ví dụ: "490000"

        $subtotal = $unit_price * $quantity;
        $total_price_vnd += $subtotal; 

        // Lưu thông tin chi tiết để hiển thị
        $cart_details[] = [
            'id' => $product_id,
            'name' => $product_info['name'],
            'price_display' => $product_info['price'],
            'qty' => $quantity,
            'img' => $product_info['img'],
            // Định dạng thành tiền lại về chuẩn VND
            'subtotal_display' => number_format($subtotal, 0, ',', '.') . 'đ'
        ];
    }
}

// Hàm định dạng tổng tiền
$total_display = number_format($total_price_vnd, 0, ',', '.') . 'đ';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ Hàng Của Bạn | flowerCorner</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* CSS Nhanh cho Giỏ hàng */
        body { font-family: Arial, sans-serif; }
        .cart-container { max-width: 900px; margin: 50px auto; padding: 0 15px; }
        .cart-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .cart-table th, .cart-table td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        .cart-table th { background-color: #f7f7f7; color: #333; }
        .cart-product-img { width: 80px; height: 80px; object-fit: cover; border-radius: 4px; }
        .product-details { display: flex; align-items: center; }
        .product-details span { margin-left: 15px; font-weight: 600; }
        .cart-total { text-align: right; font-size: 20px; font-weight: bold; margin-bottom: 20px; }
        .cart-actions { display: flex; justify-content: space-between; margin-top: 20px; }
        .btn-link { padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block; text-align: center; }
        .btn-continue { background-color: #ccc; color: #333; }
        .btn-checkout { background-color: #6da068; color: white; }
        .btn-update { background-color: #f0ad4e; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-weight: bold; }
        .btn-remove { color: #e9596c; text-decoration: none; font-weight: bold; }
        /* Responsive */
        @media (max-width: 600px) {
             .cart-table, .cart-table tbody, .cart-table tr, .cart-table td, .cart-table th { display: block; }
             .cart-table thead { display: none; }
             .cart-table tr { margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px; }
             .cart-table td { text-align: right; padding-left: 50%; position: relative; }
             .cart-table td::before { content: attr(data-label); position: absolute; left: 10px; font-weight: bold; }
             .product-details { justify-content: flex-end; }
        }
    </style>
</head>
<body>
<?php include "layout/header.php" ?>
<div class="cart-container">
    <h1>Giỏ Hàng Của Bạn</h1>
    
    <?php if (empty($cart_details)): ?>
        <div class="" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
            <div class="empty_cart-img" style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
              <img src="img/empty_cart.png" alt="ảnh empty cart">
            </div>
            <div class="" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
              <p>Giỏ hàng của bạn hiện đang trống. </p>
              <a href="index.php">Tiếp tục mua sắm</a>
            </div>
        </div>
    <?php else: ?>
        
        <form action="update_cart.php" method="POST">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_details as $item): ?>
                        <tr>
                            <td data-label="Sản phẩm">
                                <div class="product-details">
                                    <img src="<?php echo htmlspecialchars($item['img']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="cart-product-img">
                                    <span><?php echo htmlspecialchars($item['name']); ?></span>
                                </div>
                            </td>
                            <td data-label="Giá"><?php echo $item['price_display']; ?></td>
                            <td data-label="Số lượng">
                                <input type="number" 
                                      name="qty_<?php echo $item['id']; ?>" 
                                      value="<?php echo $item['qty']; ?>" 
                                      min="1" 
                                      style="width: 50px; text-align: center;">
                            </td>
                            <td data-label="Thành tiền"><?php echo $item['subtotal_display']; ?></td>
                            <td data-label="Xóa">
                                <a href="update_cart.php?action=remove&id=<?php echo $item['id']; ?>" class="btn-remove">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <div style="text-align: right; margin-bottom: 20px;">
                <button type="submit" name="action" value="update" class="btn-update">
                    Cập nhật Giỏ hàng
                </button>
            </div>
        </form>

        <div class="cart-total">
            Tổng cộng: <?php echo $total_display; ?>
        </div>
        
        <div class="cart-actions">
            <a href="index.php" class="btn-link btn-continue">Tiếp tục mua sắm</a>
            <a href="checkout.php" class="btn-link btn-checkout">Thanh toán</a>
        </div>
        
    <?php endif; ?>
</div>
<?php include "layout/footer.php" ?>

</body>
</html>