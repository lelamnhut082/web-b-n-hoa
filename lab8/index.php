<?php
session_start();
require_once 'config/config.php';

// Simple Autoloader
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/app/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

use App\Controllers\Frontend\HomeController;
use App\Controllers\Frontend\ProductController;
use App\Controllers\Frontend\AuthController;
use App\Controllers\Frontend\CartController;
use App\Controllers\Backend\AdminController;

$act = $_GET['act'] ?? 'home';

switch ($act) {
    case 'home':
        (new HomeController())->index();
        break;
    case 'detail':
        (new ProductController())->detail();
        break;
    case 'login':
        (new AuthController())->login();
        break;
    case 'register':
        (new AuthController())->register();
        break;
    case 'logout':
        (new AuthController())->logout();
        break;
    case 'checkout':
        (new CartController())->checkout();
        break;
    case 'cart':
        (new CartController())->index();
        break;
    case 'admin':
        $page = $_GET['page'] ?? 'dashboard';
        $controller = new AdminController();
        if ($page === 'products') {
            $controller->products();
        } elseif ($page === 'orders') {
            $controller->orders();
        } elseif ($page === 'categories') {
            $controller->categories();
        } elseif ($page === 'users') {
            $controller->users();
        } elseif ($page === 'out_of_stock') {
            $controller->outOfStock();
        } elseif ($page === 'best_selling') {
            $controller->bestSelling();
        } else {
            $controller->index();
        }
        break;
    case 'products':
        (new ProductController())->index();
        break;
    case 'contact':
        (new HomeController())->contact();
        break;
    case 'faq':
        (new HomeController())->faq();
        break;
    default:
        (new HomeController())->index();
        break;
}