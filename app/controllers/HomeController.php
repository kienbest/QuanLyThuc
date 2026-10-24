<?php
require_once APP_ROOT.'/app/services/DishService.php';
class HomeController{
    public function index(){
        //goi du lieu benh nhan
        $dishService =new DishService();
        $dishes =$dishService->getAllDishes();

        include APP_ROOT.'/app//views/home/index.php';
    }
}
?>