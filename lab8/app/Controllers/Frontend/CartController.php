<?php
namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\Product;

class CartController extends BaseController {
    public function index() {
        $action = $_GET['action'] ?? 'view';
        
        if ($action === 'add') {
            $this->addToCart();
        } elseif ($action === 'remove') {
            $this->removeFromCart();
        } elseif ($action === 'update') {
            $this->updateCart();
        } else {
            $this->viewCart();
        }
    }

    private function addToCart() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $productModel = new Product();
            $product = $productModel->find($id);
            if ($product) {
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }
                
                if (isset($_SESSION['cart'][$id])) {
                    $_SESSION['cart'][$id]['quantity']++;
                } else {
                    $_SESSION['cart'][$id] = [
                        'id' => $product['id'],
                        'name' => $product['name'],
                        'price' => $product['price'],
                        'img' => $product['img'],
                        'quantity' => 1
                    ];
                }
            }
        }
        $this->redirect('index.php?act=cart');
    }

    private function removeFromCart() {
        $id = $_GET['id'] ?? null;
        if ($id && isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
        $this->redirect('index.php?act=cart');
    }

    private function updateCart() {
        // Implement update logic (e.g. from POST)
        // For simplicity, maybe just view for now or handle POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $quantities = $_POST['quantity'] ?? [];
            foreach ($quantities as $id => $qty) {
                if (isset($_SESSION['cart'][$id])) {
                    if ($qty > 0) {
                        $_SESSION['cart'][$id]['quantity'] = (int)$qty;
                    } else {
                        unset($_SESSION['cart'][$id]);
                    }
                }
            }
        }
        $this->redirect('index.php?act=cart');
    }

    private function viewCart() {
        $this->view('Frontend/cart/index');
    }

    public function checkout() {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = 'Vui lòng đăng nhập để thanh toán.';
            $this->redirect('index.php?act=login');
        }

        if (empty($_SESSION['cart'])) {
            $this->redirect('index.php?act=cart');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processCheckout();
        } else {
            $this->view('Frontend/cart/checkout');
        }
    }

    private function processCheckout() {
        $userId = $_SESSION['user_id'];
        $cart = $_SESSION['cart'];
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $orderModel = new \App\Models\Order();
        $orderId = $orderModel->create($userId, $total);

        $orderDetailModel = new \App\Models\OrderDetail();
        foreach ($cart as $item) {
            $orderDetailModel->create($orderId, $item['id'], $item['quantity'], $item['price']);
        }

        unset($_SESSION['cart']);
        $_SESSION['success'] = 'Đặt hàng thành công! Mã đơn hàng: #' . $orderId;
        $this->redirect('index.php');
    }
}
