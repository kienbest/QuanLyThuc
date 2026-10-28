<?php
require_once APP_ROOT . '/app/services/UserService.php';

class UserController {
    private $userService;

    public function __construct() {
        $this->userService = new UserService();
    }

    public function login() {
        require_once APP_ROOT . '/app/views/user/login.php';
    }

    public function handleLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ten_dang_nhap = trim($_POST['ten_dang_nhap'] ?? '');
            $mat_khau = trim($_POST['mat_khau'] ?? '');

            $user = $this->userService->login($ten_dang_nhap, $mat_khau);

            if ($user) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['user'] = [
                    'id' => $user['ma_nguoi_dung'],
                    'ten_dang_nhap' => $user['ten_dang_nhap'],
                    'ho_ten' => $user['ho_ten']
                ];
                header('Location: ' . DOMAIN . 'public/?controller=home&action=index');
                exit;
            } else {
                $error = "Tên đăng nhập hoặc mật khẩu không chính xác!";
                include APP_ROOT . '/app/views/user/login.php';
            }
        }
    }

    public function register() {
        require_once APP_ROOT . '/app/views/user/register.php';
    }

    public function handleRegister() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ho_ten = trim($_POST['ho_ten'] ?? '');
            $ten_dang_nhap = trim($_POST['ten_dang_nhap'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $mat_khau = trim($_POST['mat_khau'] ?? '');

            if ($this->userService->checkUserExists($ten_dang_nhap)) {
                $error = "Tên đăng nhập đã tồn tại, vui lòng chọn tên khác!";
                include APP_ROOT . '/app/views/user/register.php';
            } else {
                $result = $this->userService->register($ten_dang_nhap, $mat_khau, $ho_ten, $email);
                if ($result) {
                    $success = "Đăng ký thành công! Mời bạn đăng nhập.";
                    include APP_ROOT . '/app/views/user/login.php';
                } else {
                    $error = "Đã xảy ra lỗi trong quá trình đăng ký!";
                    include APP_ROOT . '/app/views/user/register.php';
                }
            }
        }
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['user']);
        session_destroy();
        header('Location: ' . DOMAIN . 'public/?controller=user&action=login');
        exit;
    }
}
?>