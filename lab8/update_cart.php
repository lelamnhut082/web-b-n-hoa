<?php
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
$action = $_GET['action'] ?? $_POST['action'] ?? null;
$product_id = $_GET['id'] ?? null;
$quantity = $_GET['qty'] ?? 1;

if ($product_id && is_numeric($product_id)) {
    $product_id = (int)$product_id;
} else {
}
if ($product_id && $action === 'add') {
    
    $quantity = (int)$quantity; 

    // Kiểm tra số lượng hợp lệ
    if ($quantity <= 0) {
        $quantity = 1;
    }

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['qty'] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = [
            'id' => $product_id,
            'qty' => $quantity
        ];
    }
    
    header('Location: giohang.php'); 
    exit();
}
if ($product_id && $action === 'remove') {
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
    header('Location: giohang.php'); 
    exit();
}
if ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'qty_') === 0) {
            $id = (int)str_replace('qty_', '', $key);
            $new_qty = (int)$value;
            
            if ($id > 0 && isset($_SESSION['cart'][$id])) {
                if ($new_qty <= 0) {
                    unset($_SESSION['cart'][$id]);
                } else {
                    $_SESSION['cart'][$id]['qty'] = $new_qty;
                }
            }
        }
    }
    
    header('Location: giohang.php'); 
    exit();
}
header('Location: index.php');
exit();
?>