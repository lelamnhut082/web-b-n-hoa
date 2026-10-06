<?php
$json_data = file_get_contents('products.json');
$products = json_decode($json_data, true);

$current_product = null;
$requested_id = null;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
	$requested_id = (int)$_GET['id'];
	foreach ($products as $product) {
		if (isset($product['id']) && $product['id'] === $requested_id) {
			$current_product = $product;
			break;
		}
	}
}

if (!$current_product) {
	die("<h1>Lỗi 404: Sản phẩm không tồn tại hoặc ID không hợp lệ.</h1>");
}

$product_name = htmlspecialchars($current_product['name'] ?? 'Tên sản phẩm');
$product_price = htmlspecialchars($current_product['price'] ?? 'Liên hệ');
$product_old_price = htmlspecialchars($current_product['old_price'] ?? '');
$product_img = htmlspecialchars($current_product['img'] ?? 'img/default.webp');
$product_desc_dynamic = htmlspecialchars($current_product['description'] ?? '');

?>
<!DOCTYPE html>
<html lang="vi">

<head>
	<link rel="stylesheet" href="css/style.css">
	<meta charset="UTF-8">
	<title>Chi tiết: <?php echo $product_name; ?> | flowerCorner</title>
	<style>
		.container {
			max-width: 1000px;
			margin: 50px auto;
			padding: 0 15px;
		}

		.product-detail {
			display: flex;
			gap: 40px;
		}

		.product-detail .left {
			flex: 1;
		}

		.product-detail .right {
			flex: 1;
		}

		.product-detail img {
			width: 100%;
			height: auto;
			border-radius: 8px;
		}

		.product-detail h1 {
			font-size: 32px;
			color: #333;
			margin-top: 0;
		}

		.product-detail .price {
			font-size: 24px;
			color: #e9596c;
			margin-bottom: 20px;
		}

		.product-detail .price del {
			color: #888;
			margin-right: 10px;
			font-size: 18px;
		}

		.description {
			
			border-top: 3px solid #373737;
			padding-top: 10px;
			font-size: 16px;
			color: #333;
			margin-bottom: 30px;
		}

		.info-section h3 {
			font-size: 18px;
			color: #6da068;
			border-bottom: 3px solid #373737;
			padding-bottom: 5px;
			margin-top: 20px;
		}

		.info-section {
			font-size: 16px;
			color: #333;
		}
		.order-btn {
			display: block;
			width: 100%;
			text-align: center;
			background-color: #f7a9a8;
			color: white;
			padding: 15px;
			text-decoration: none;
			font-weight: bold;
			border-radius: 5px;
			margin-top: 10px;
			transition: background-color 0.3s;
		}

		.order-btn:hover {
			background-color: #e9596c;
		}

		@media (max-width: 768px) {
			.product-detail {
				flex-direction: column;
			}
		}
	</style>
</head>

<body>
	<?php include 'layout/header.php'; ?>
	<div class="container">
		<div class="product-detail">

			<div class="left">
				<img src="<?php echo $product_img; ?>" alt="<?php echo $product_name; ?>">
			</div>

			<div class="right">

				<h1><?php echo $product_name; ?></h1>

				<p class="price">
					<?php if ($product_old_price): ?>
						<del><?php echo $product_old_price; ?></del>
					<?php endif; ?>
					<?php echo $product_price; ?>
				</p>

				<div class="description">
					<?php
					if ($product_desc_dynamic) {
						echo $product_desc_dynamic;
					} else {
						echo "Những tia nắng lấp lánh len qua cánh lá khiến hoa thêm rực rỡ, tươi tắn, ấm áp. Như một lời chúc mừng đầy cảm xúc. Bó hoa này phù hợp với nhiều dịp như mừng sinh nhật, mừng khai trương,...";
					}
					?>
				</div>

				<div class="info-section">
					<h3>Chi tiết bó hoa</h3>
					<ul style="margin-top: 10px; margin-left: 20px;">
						<li>Hoa hồng kem: 12 cành</li>
						<li>Các loại lá phụ: Lá chanh</li>
						<li>Các sản phẩm cây sơn tùng đều được trang trí 2 mặt phụ kiện và có thể chênh lệch từ 5-10cm so với mô tả</li>
						<li>Sản phẩm cần đặt trước 2-3 ngày.</li>
						<li>Sản phẩm chỉ cung cấp tại khu vực TP.HCM và vào dịp lễ giáng sinh</li>
					</ul>
				</div>

				<div class="info-section">
					<h3>Lưu ý</h3>
					<p style="margin-top: 5px;">
						Do đặc điểm thủ công, sản phẩm thực tế có thể khác nhẹ so với hình trên website.
						FlowerCorner cam kết sản phẩm giống khoảng 80% so với hình.
						Tùy theo mùa, loại hoa phụ sẽ thay đổi phù hợp nhất.
					</p>
				</div>

				<a href="update_cart.php?action=add&id=<?php echo $requested_id; ?>" class="order-btn">ĐẶT HOA NGAY</a>

			</div>
		</div>
	</div>
	<?php include 'layout/footer.php'; ?>
</body>

</html>