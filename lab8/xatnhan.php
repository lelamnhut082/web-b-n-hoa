<?php
session_start();
if (!isset($_SESSION["order"])) {
    header("Location: thanhtoan.php");
    exit;
}
$order = $_SESSION["order"];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Đặt hàng thành công</title>
<style>
    
    body { font-family: 'Arial', sans-serif; background-color: #fcfcfc; margin: 0; padding: 0; color: #333; }
    .container { max-width: 600px; margin: 60px auto; padding: 0 15px; text-align: center; }
    .invoice-box { background-color: white; border: 1px solid #e0e0e0; border-radius: 12px; box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08); padding: 30px 40px; text-align: left; }
    .invoice-box h2 { color: #6da068; font-size: 28px; margin-bottom: 5px; }
    .invoice-box p:first-of-type { color: #666; margin-bottom: 30px; border-bottom: 1px solid #eee; padding-bottom: 15px; text-align: center; font-size: 15px; }
    .invoice-box h3 { font-size: 18px; color: #333; margin-top: 20px; margin-bottom: 10px; padding-bottom: 5px; border-bottom: 2px solid #f7a9a8; }
    .order-info { font-size: 15px; line-height: 1.6; margin-bottom: 20px; }
    .order-info p { margin: 8px 0; }
    .order-info b { display: inline-block; width: 100px; color: #555; font-weight: 600; }
    .total-amount { text-align: center; padding: 15px 0; margin-top: 20px; border-top: 1px dashed #ccc; }
    .total-amount span { font-size: 24px; font-weight: bold; color: #e9596c; }
    .back-home { display: inline-block; margin-top: 30px; padding: 10px 20px; background-color: #6da068; color: white !important; text-decoration: none; border-radius: 6px; font-weight: bold; transition: background-color 0.3s; }
    .back-home:hover { background-color: #f7a9a8; }
</style>
</head>
<body>

<div class="container">
    <div class="invoice-box">
        <h2 style="text-align:center;">🎉 ĐẶT HÀNG THÀNH CÔNG!</h2>
        <p>Đơn hàng của bạn đã được tiếp nhận. flowerCorner sẽ xử lý đơn hàng trong thời gian sớm nhất.</p>

        <h3>Thông tin đơn hàng</h3>
        <div class="order-info">
            <p><b>Mã đơn hàng:</b> #FC-<?php echo date('Ymd') . rand(1000, 9999); ?></p> 
            <p><b>Họ tên:</b> <?= $order["hoten"] ?></p>
            <p><b>SĐT:</b> <?= $order["sdt"] ?></p>
            <p><b>Địa chỉ:</b> <?= $order["diachi"] ?>, <?= $order["quanhuyen"] ?>, <?= $order["thanhpho"] ?></p>
            <p><b>Ghi chú:</b> <?= empty($order["ghichu"]) ? 'Không có ghi chú.' : $order["ghichu"] ?></p>
        </div>
        
        <div class="total-amount">
            Tổng thanh toán: 
            <span><?= number_format($order["tongtien"], 0, ',', '.') ?> đ</span>
        </div>

        <div style="text-align: center;">
            <a href="index.php" class="back-home">Quay lại Trang chủ</a>
        </div>
    </div>
</div>

</body>
</html>