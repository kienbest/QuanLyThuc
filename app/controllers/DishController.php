<?php

require_once APP_ROOT . '/app/services/DishService.php';

class DishController
{
    // Kiểm tra đăng nhập
    private function checkLogin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['user']['id'])) {
            header('Location: ' . DOMAIN . 'public/?controller=user&action=login');
            exit;
        }

        return $_SESSION['user']['id'];
    }

    public function index()
    {
        $maNguoiDung = $this->checkLogin();
        $dishService = new DishService();
        $dishes = $dishService->getAllDishes($maNguoiDung);

        include APP_ROOT . '/app/views/dish/index.php';
    }

    public function add()
    {
        $this->checkLogin();

        include_once APP_ROOT . '/app/views/dish/add.php';
    }

    public function store()
    {
        $maNguoiDung = $this->checkLogin();

        $tenMonAn = $_POST['ten_mon_an'];
        $nguyenLieu = $_POST['nguyen_lieu'];
        $cachCheBien = $_POST['cach_che_bien'];

        $dish = new Dish(null, $maNguoiDung, $tenMonAn, $nguyenLieu, $cachCheBien);

        $dishService = new DishService();
        $dishService->addDish($dish, $maNguoiDung);

        header('Location: ?controller=dish&action=index');
        exit;
    }

    public function edit()
    {
        $maNguoiDung = $this->checkLogin();

        $maMonAn = $_GET['id'] ?? null;

        if (isset($maMonAn)) {
            $dishService = new DishService();
            $dish = $dishService->getDishById($maMonAn, $maNguoiDung);

            if ($dish) {
                include APP_ROOT . '/app/views/dish/edit.php';
            } else {
                echo 'Không tìm thấy món ăn';
            }
        } else {
            echo 'Id is null';
        }
    }

    public function update()
    {
        $maNguoiDung = $this->checkLogin();

        $maMonAn = $_POST['ma_mon_an'] ?? null;
        $tenMonAn = $_POST['ten_mon_an'] ?? '';
        $nguyenLieu = $_POST['nguyen_lieu'] ?? '';
        $cachCheBien = $_POST['cach_che_bien'] ?? '';

        if ($maMonAn === null) {
            exit('Mã món ăn không hợp lệ');
        }

        $dish_new = new Dish($maMonAn, $maNguoiDung, $tenMonAn, $nguyenLieu, $cachCheBien);

        $dishService = new DishService();
        $dishService->editDish($dish_new, $maNguoiDung);

        header('Location: ?controller=dish&action=index');
        exit;
    }

    public function delete()
    {
        $maNguoiDung = $this->checkLogin();

        $maMonAn = $_GET['id'] ?? null;

        if (isset($maMonAn)) {
            $dishService = new DishService();
            $dish = $dishService->getDishById($maMonAn, $maNguoiDung);

            if ($dish) {
                include APP_ROOT . '/app/views/dish/delete.php';
            } else {
                echo 'Không tìm thấy món ăn';
            }
        } else {
            echo 'Id is null';
        }
    }

    public function destroy()
    {
        $maNguoiDung = $this->checkLogin();

        $maMonAn = $_POST['ma_mon_an'] ?? null;

        if (isset($maMonAn)) {
            $dishService = new DishService();
            $dishService->deleteDish($maMonAn, $maNguoiDung);

            header('Location: ?controller=dish&action=index');
            exit;
        } else {
            echo 'Id is null';
        }
    }
}
?>
