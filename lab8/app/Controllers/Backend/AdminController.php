<?php
namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Product;
use App\Models\Category;

class AdminController extends BaseController {
    
    public function __construct() {
        // Enforce Admin Access
        // if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
        //     $_SESSION['error'] = 'Bạn không có quyền truy cập.';
        //     $this->redirect('index.php?act=login');
        // }
    }

    public function index() {
        $this->view('Backend/admin/dashboard');
    }

    public function orders() {
        $orderModel = new \App\Models\Order();
        $action = $_GET['action'] ?? 'list';

        if ($action === 'update_status') {
            $id = $_GET['id'] ?? null;
            $status = $_POST['status'] ?? null;
            if ($id && $status && $_SERVER['REQUEST_METHOD'] === 'POST') {
                // Lấy thông tin đơn hàng hiện tại
                $currentOrder = $orderModel->find($id);

                // Cập nhật trạng thái
                $orderModel->updateStatus($id, $status);
                $_SESSION['success'] = 'Cập nhật trạng thái đơn hàng thành công.';

                // Nếu chuyển sang completed và trước đó chưa completed thì cập nhật kho
                if ($status === 'completed' && $currentOrder['status'] !== 'completed') {
                    $orderDetailModel = new \App\Models\OrderDetail();
                    $productModel = new \App\Models\Product();
                    
                    $details = $orderDetailModel->getByOrderId($id);
                    if ($details) {
                        foreach ($details as $item) {
                            $productModel->updateStockAndSold($item['product_id'], $item['quantity']);
                        }
                    }
                }
            }
            $this->redirect('index.php?act=admin&page=orders');
        } else {
            $orders = $orderModel->getAllOrders();
            $this->view('Backend/admin/orders/index', [
                'orders' => $orders
            ]);
        }
    }

    public function products() {
        $productModel = new Product();
        $action = $_GET['action'] ?? 'list';

        if ($action === 'delete') {
            $id = $_GET['id'] ?? null;
            if ($id) {
                $productModel->delete($id);
                $_SESSION['success'] = 'Đã xóa sản phẩm.';
            }
            $this->redirect('index.php?act=admin&page=products');
        } elseif ($action === 'store') {
            // Handle create/update
            $this->storeProduct();
        } else {
            $products = $productModel->getAllWithCategory();
            // Fetch categories for the add/edit form
            $categoryModel = new Category();
            $categories = $categoryModel->getAll();
            
            $editProduct = null;
            if (isset($_GET['id']) && $action === 'edit') {
                $editProduct = $productModel->find($_GET['id']);
            }

            $this->view('Backend/admin/products/index', [
                'products' => $products,
                'categories' => $categories,
                'editProduct' => $editProduct
            ]);
        }
    }

    private function storeProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $name = $_POST['name'] ?? '';
            $price = $_POST['price'] ?? 0;
            $categoryId = $_POST['category_id'] ?? null;
            $description = $_POST['description'] ?? '';
            
            $quantity = (int)($_POST['quantity'] ?? 0);
            
            // Handle File Upload
            $img = $_POST['existing_img'] ?? '';
            if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                $filename = uniqid() . '_' . basename($_FILES['img']['name']);
                move_uploaded_file($_FILES['img']['tmp_name'], $uploadDir . $filename);
                $img = $uploadDir . $filename;
            }

            $productModel = new Product();

            if ($id) {
                // Update
                $sql = "UPDATE products SET name=?, price=?, quantity=?, category_id=?, img=?, description=? WHERE id=?";
                $params = [$name, $price, $quantity, $categoryId, $img, $description, $id];
                $productModel->execute($sql, $params);
                $_SESSION['success'] = 'Cập nhật sản phẩm thành công.';
            } else {
                // Insert
                $sql = "INSERT INTO products (name, price, quantity, category_id, img, description) VALUES (?, ?, ?, ?, ?, ?)";
                $params = [$name, $price, $quantity, $categoryId, $img, $description];
                $productModel->execute($sql, $params);
                $_SESSION['success'] = 'Thêm sản phẩm thành công.';
            }
            
            $this->redirect('index.php?act=admin&page=products');
        }
    }

    public function categories() {
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();
        $this->view('Backend/admin/categories/index', [
            'categories' => $categories
        ]);
    }

    public function users() {
        $userModel = new \App\Models\User();
        $users = $userModel->getAll();
        $this->view('Backend/admin/users/index', [
            'users' => $users
        ]);
    }

    public function outOfStock() {
        $productModel = new Product();
        $products = $productModel->getOutOfStock();
        $this->view('Backend/admin/products/out_of_stock', [
            'products' => $products
        ]);
    }

    public function bestSelling() {
        $productModel = new Product();
        $products = $productModel->getBestSelling(10);
        $this->view('Backend/admin/products/best_selling', [
            'products' => $products
        ]);
    }
}
