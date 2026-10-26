
<?php
require_once APP_ROOT.'/app/services/DishService.php';

class DishController {

    public function redirect() {
        header('Location: '.DOMAIN.'public/');
        exit;
    }

    public function index() {
        $dishService = new DishService();
        $dishes = $dishService->getAllDishes();

        include APP_ROOT.'/app/views/dish/index.php';
    }

    public function add() {
        include APP_ROOT.'/app/views/dish/add.php';
    }

    public function store() {
        $masv = $_POST['masv'] ?? '';
        $tensv = $_POST['tensv'] ?? '';
        $lop = $_POST['lop'] ?? '';
        $khoa = $_POST['khoa'] ?? '';

        $dishService = new DishService();
        $dishService->addDish($masv, $tensv, $lop, $khoa);

        $this->redirect();
    }

    public function edit() {
        $MaSv = $_GET['MaSv'] ?? '';

        $dishService = new DishService();
        $dish = $dishService->getDishById($MaSv);

        include APP_ROOT.'/app/views/dish/edit.php';
    }

    public function update() {
        $MaSv = $_POST['masv'] ?? '';
        $TenSv = $_POST['tensv'] ?? '';
        $Lop = $_POST['lop'] ?? '';
        $Khoa = $_POST['khoa'] ?? '';

        $dishService = new DishService();
        $dishService->editDish($MaSv, $TenSv, $Lop, $Khoa);

        $this->redirect();
    }

    public function delete() {
        $masv = $_GET['MaSv'] ?? '';

        $dishService = new DishService();
        $dishService->deleteDish($masv);

        $this->redirect();
    }

    public function destroy() {
        $masv = $_POST['masv'] ?? '';

        $dishService = new DishService();
        $dishService->deleteDish($masv);

        $this->redirect();
    }
}
?>
