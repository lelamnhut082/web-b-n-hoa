<?php
namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\User;

class AuthController extends BaseController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            
            $userModel = new User();
            $user = $userModel->getByEmail($email);
            
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_role'] = $user['role'];
                $this->redirect('index.php');
            } else {
                $_SESSION['error'] = 'Email hoặc mật khẩu không chính xác.';
                $this->redirect('index.php?act=login');
            }
        } else {
            $this->view('Frontend/auth/login');
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['password_confirm'] ?? '';
            
            if ($password !== $confirm_password) {
                $_SESSION['error'] = 'Mật khẩu xác nhận không khớp.';
                $this->redirect('index.php?act=register');
            }
            
            $userModel = new User();
            if ($userModel->getByEmail($email)) {
                $_SESSION['error'] = 'Email đã tồn tại.';
                $this->redirect('index.php?act=register');
            }
            
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $userModel->create([
                'name' => $name,
                'email' => $email,
                'password' => $hashed_password
            ]);
            
            $_SESSION['success'] = 'Đăng ký thành công. Vui lòng đăng nhập.';
            $this->redirect('index.php?act=login');
        } else {
            $this->view('Frontend/auth/register');
        }
    }

    public function logout() {
        session_destroy();
        $this->redirect('index.php');
    }
}
