<?php
namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\Product;
use App\Models\Category;

class HomeController extends BaseController {
    public function index() {
        $productModel = new Product();
        $products = $productModel->getAllWithCategory();

        $this->view('Frontend/home/index', [
            'products' => $products
        ]);
    }

    public function contact() {
        $this->view('Frontend/home/contact');
    }

    public function faq() {
        $this->view('Frontend/home/faq');
    }
}
