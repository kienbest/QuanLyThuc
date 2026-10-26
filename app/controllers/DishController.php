
<?php

require_once APP_ROOT . '/app/services/DishService.php';

class DishController
{
    public function index()
    {
        $dishService = new DishService();
        $dishes = $dishService->getAllDishes();

        include APP_ROOT . '/app/views/dish/index.php';
    }

    public function add()
    {
        include_once APP_ROOT . '/app/views/dish/add.php';
    }

    public function store()
    {
        $maNguoiDung = $_POST['ma_nguoi_dung'];
        $tenMonAn = $_POST['ten_mon_an'];
        $nguyenLieu = $_POST['nguyen_lieu'];
        $cachCheBien = $_POST['cach_che_bien'];

        $dish = new Dish(null, $maNguoiDung, $tenMonAn, $nguyenLieu, $cachCheBien);

        $dishService = new DishService();
        $dishService->addDish($dish);

        header('Location: ?controller=dish&action=index');
        exit;
    }

    public function edit()
    {
        $maMonAn = $_GET['id'] ?? null;

        if (isset($maMonAn)) {
            $dishService = new DishService();
            $dish = $dishService->getDishById($maMonAn);

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
        $maMonAn = $_POST['ma_mon_an'] ?? null;
        $maNguoiDung = $_POST['ma_nguoi_dung'] ?? '';
        $tenMonAn = $_POST['ten_mon_an'] ?? '';
        $nguyenLieu = $_POST['nguyen_lieu'] ?? '';
        $cachCheBien = $_POST['cach_che_bien'] ?? '';

        if ($maMonAn === null) {
            exit('Mã món ăn không hợp lệ');
        }

        $dish_new = new Dish($maMonAn, $maNguoiDung, $tenMonAn, $nguyenLieu, $cachCheBien);

        $dishService = new DishService();
        $dishService->editDish($dish_new);

        header('Location: ?controller=dish&action=index');
        exit;
    }

    public function delete()
    {
        $maMonAn = $_GET['id'] ?? null;

        if (isset($maMonAn)) {
            $dishService = new DishService();
            $dish = $dishService->getDishById($maMonAn);

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
        $maMonAn = $_POST['ma_mon_an'] ?? null;

        if (isset($maMonAn)) {
            $dishService = new DishService();
            $dishService->deleteDish($maMonAn);

            header('Location: ?controller=dish&action=index');
            exit;
        } else {
            echo 'Id is null';
        }
    }
}
?>
