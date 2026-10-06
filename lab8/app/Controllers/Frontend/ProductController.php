<?php
namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\Product;

class ProductController extends BaseController {
    public function index() {
        $productModel = new Product();
        $products = $productModel->getAllWithCategory();

        $this->view('Frontend/home/index', [
            'products' => $products
        ]);
    }

    public function detail() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect('index.php');
        }

        $productModel = new Product();
        $product = $productModel->find($id);

        if (!$product) {
            echo "Sản phẩm không tồn tại."; 
            // Or redirect to 404
            return;
        }

        $this->view('Frontend/products/detail', ['product' => $product]);
    }
}
