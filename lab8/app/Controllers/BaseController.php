<?php
namespace App\Controllers;

class BaseController {
    protected function view($viewPath, $data = []) {
        extract($data);
        $viewFile = "app/Views/" . $viewPath . ".php";
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            echo "View not found: " . $viewFile;
        }
    }

    protected function redirect($url) {
        header("Location: " . $url);
        exit();
    }
}
