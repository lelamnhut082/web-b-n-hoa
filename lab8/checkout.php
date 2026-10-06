<?php
session_start();
function getProductsFromJson()
{
	$file_path = 'products.json';
	if (!file_exists($file_path)) {
		return [];
	}
	$json_data = file_get_contents($file_path);
	$products = json_decode($json_data, true) ?: [];
	$products_by_id = [];
	foreach ($products as $p) {
		if (isset($p['id'])) {
			$price_string = preg_replace('/[^\d.]/', '', $p['price']);
			$p['price_numeric'] = (int)str_replace('.', '', $price_string);
			$products_by_id[$p['id']] = $p;
		}
	}
	return $products_by_id;
}

$all_products_by_id = getProductsFromJson();
$cart = $_SESSION['cart'] ?? [];
$cart_details = [];
$subtotal_vnd = 0;
$shipping_fee = 25000; // Phí vận chuyển cố định


foreach ($cart as $item_id => $item) {
	$product_id = $item['id'];
	$quantity = $item['qty'];
	$product_info = $all_products_by_id[$product_id] ?? null;

	if ($product_info) {
		$unit_price = $product_info['price_numeric'];
		$subtotal = $unit_price * $quantity;
		$subtotal_vnd += $subtotal;

		$cart_details[] = [
			'name' => $product_info['name'],
			'qty' => $quantity,
			'subtotal_display' => number_format($subtotal, 0, ',', '.') . ' đ'
		];
	}
}

$grand_total = $subtotal_vnd + $shipping_fee;

$subtotal_display = number_format($subtotal_vnd, 0, ',', '.') . ' đ';
$shipping_display = number_format($shipping_fee, 0, ',', '.') . ' đ';
$grand_total_display = number_format($grand_total, 0, ',', '.') . ' đ';

if (empty($cart_details)) {
	$_SESSION['checkout_error'] = 'Giỏ hàng của bạn đang trống. Vui lòng thêm sản phẩm.';
	header('Location: giohang.php');
	exit();
}
$user_name_session = $_SESSION['user_name'] ?? '';
?>

<!DOCTYPE html>
<html lang="vi">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/style.css">
	<title>Thanh Toán Đơn Hàng | flowerCorner</title>
	<style>
.checkout-container {
    display: flex;
    justify-content: space-between;
    gap: 30px;
    max-width: 1100px;
    margin: 40px auto;
    color: #fff;
    }

    .checkout-left {
    flex: 1.4;
    background-color: #1e1e1e; 
    border: 2px solid #d11b6b; 
    border-radius: 10px;
    padding: 30px;
    box-shadow: 0 0 8px #000;
    }

    .checkout-left h3 {
    margin-bottom: 25px;
    font-size: 20px;
    font-weight: bold;
    color: #ffb3c6;
    }

    .form-group {
    margin-bottom: 15px;
    }

    label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    font-size: 14px;
    color: #ffb3c6;
    }

    input, select, textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #555;
    border-radius: 5px;
    font-size: 14px;
    background-color: #2a2a2a;
    color: #fff;
    }

    textarea {
    resize: vertical;
    height: 80px;
    }

    .address-checkbox {
    margin: 15px 0;
    background-color: #d11b6b;
    color: white;
    font-weight: bold;
    border-radius: 6px;
    padding: 10px;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    }


    .checkout-right {
    flex: 1;
    background-color: #1e1e1e;
    border: 2px solid #ffb3c6;
    border-radius: 8px;
    padding: 25px;
    box-shadow: 0 0 8px #000;
    }

    .checkout-right h3 {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #ffb3c6;
    }

    .order-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 8px;
    font-size: 14px;
    border-bottom: 1px solid #333;
    padding-bottom: 8px;
    }

    .order-item strong {
    font-weight: bold;
    color: #fff;
    }

    .summary {
    margin-top: 10px;
    font-size: 14px;
    }

    .summary div {
    display: flex;
    justify-content: space-between;
    margin: 6px 0;
    color: #fff;
    }

    .summary .total {
    font-weight: bold;
    color: #d11b6b;
    font-size: 16px;
    margin-top: 10px;
    }

    .payment-box {
    margin-top: 15px;
    background-color: #2a2a2a;
    border: 1px solid #555;
    border-radius: 6px;
    padding: 10px;
    font-size: 14px;
    line-height: 1.5;
    color: #eee;
    }

    .btn-order {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    color: white;
    background-color: #d11b6b;
    border: none;
    border-radius: 6px;
    margin-top: 15px;
    cursor: pointer;
    font-weight: bold;
    transition: 0.3s;
    }

    .btn-order:hover {
    background-color: white;
    color: #d11b6b;
    }

    .back-cart {
    display: block;
    text-align: center;
    margin-top: 10px;
    color: #ffb3c6;
    text-decoration: none;
    font-size: 14px;
    }

    .back-cart:hover {
    text-decoration: underline;
    }

	</style>
</head>

<body>
	<?php include "layout/header.php" ?>
	<div class="container">
		<form method="POST" action="thanhtoan.php">
			<div class="checkout-container">

				<div class="checkout-left">
					<h3>Thông tin thanh toán</h3>

					<div class="form-group">
						<label>Họ và tên *</label>
						<input name="hoten" type="text" required placeholder="Nhập họ và tên" value="<?php echo $user_name_session; ?>">
					</div>

					<div class="form-group">
						<label>Số điện thoại *</label>
						<input name="sdt" type="text" required placeholder="Nhập số điện thoại">
					</div>

					<div class="form-group"><label>Tỉnh/Thành phố *</label><select name="thanhpho">
							<option>Tp. Hồ Chí Minh</option>
							<option>Hà Nội</option>
							<option>Đà Nẵng</option>
						</select></div>
					<div class="form-group"><label>Quận/Huyện *</label><select name="quanhuyen">
							<option>Chọn quận/huyện</option>
							<option value="1">Quận 1</option>
							<option value="3">Quận 3</option>
							<option value="5">Quận 5</option>
							<option value="7">Quận 7</option>
							<option value="10">Quận 10</option>
							<option value="BinhThanh">Quận Bình Thạnh</option>
							<option value="GoVap">Quận Gò Vấp</option>
							<option value="PhuNhuan">Quận Phú Nhuận</option>
							<option value="TanBinh">Quận Tân Bình</option>
							<option value="ThuDuc">TP. Thủ Đức</option>

						</select></div>

					<div class="form-group">
						<label>Địa chỉ *</label>
						<input name="diachi" type="text" required placeholder="Số nhà, tên đường...">
					</div>

					<div class="form-group">
						<label>Ghi chú đơn hàng (tùy chọn)</label>
						<textarea name="ghichu" placeholder="Ghi chú đơn hàng..."></textarea>
					</div>
				</div>

				<div class="checkout-right">
					<h3>Đơn hàng của bạn</h3>

					<?php foreach ($cart_details as $item): ?>
						<div class="order-item">
							<strong><?php echo htmlspecialchars($item['name']) . ' ×' . $item['qty']; ?></strong>
							<span><?php echo $item['subtotal_display']; ?></span>
						</div>
					<?php endforeach; ?>

					<div class="summary">
						<div><span>Tạm tính</span><span><?php echo $subtotal_display; ?></span></div>
						<div><span>Giao hàng</span><span><?php echo $shipping_display; ?></span></div>
						<div style="font-size:13px;color:#666;text-align:right;">Vận chuyển đến Tp. Hồ Chí Minh</div>
						<div class="total"><span>Tổng</span><span><?php echo $grand_total_display; ?></span></div>
					</div>

					<div class="payment-box">
						<input type="radio" name="payment_method" value="COD" checked>
						<b>Thanh toán tiền mặt khi nhận hàng (COD)</b><br>
						<p style="margin-top: 5px;">Bạn sẽ thanh toán trực tiếp với shipper khi nhận sản phẩm.</p>
					</div>

					<input type="hidden" name="total_amount" value="<?php echo $grand_total; ?>">

					<button class="btn-order" type="submit">ĐẶT HÀNG</button>
					<a href="giohang.php" class="back-cart">Quay lại giỏ hàng</a>
				</div>

			</div>
		</form>
	</div>
	<?php include "layout/footer.php"  ?>
</body>

</html>