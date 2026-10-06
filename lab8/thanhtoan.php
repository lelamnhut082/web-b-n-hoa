<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit();
}

if (empty($_SESSION['cart'])) {
    $_SESSION['checkout_error'] = 'Giỏ hàng của bạn đang trống. Không thể thanh toán.';
    header('Location: giohang.php');
    exit();
}

// Đảm bảo các trường bắt buộc đã được điền
if (empty($_POST['hoten']) || empty($_POST['sdt']) || empty($_POST['diachi'])) {
    $_SESSION['checkout_error'] = 'Vui lòng điền đầy đủ các thông tin bắt buộc (Họ tên, SĐT, Địa chỉ).';
    header('Location: checkout.php');
    exit();
}

$hoten = trim($_POST['hoten']);
$sdt = trim($_POST['sdt']);
$thanhpho = $_POST['thanhpho'] ?? 'Tp. Hồ Chí Minh';
$quanhuyen = $_POST['quanhuyen'] ?? 'Chọn quận/huyện';
$diachi = trim($_POST['diachi']);
$ghichu = trim($_POST['ghichu'] ?? '');
$payment_method = $_POST['payment_method'] ?? 'COD';

$tongtien_raw = $_POST['total_amount'] ?? 0; // Giá trị số nguyên (ví dụ: 1105000)

$_SESSION['order'] = [
    'order_id' => 'FC-' . date('Ymd') . rand(1000, 9999), // Tạo ID đơn hàng giả
    'hoten' => $hoten,
    'sdt' => $sdt,
    'thanhpho' => $thanhpho,
    'quanhuyen' => $quanhuyen,
    'diachi' => $diachi,
    'ghichu' => $ghichu,
    'tongtien' => $tongtien_raw,
    'payment' => $payment_method,
    'products_in_cart' => $_SESSION['cart'] // Giữ lại chi tiết sản phẩm
];

unset($_SESSION['cart']); 


header('Location: xatnhan.php');
exit();
?>