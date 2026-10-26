<?php

require_once('../app/config/config.php');
require_once APP_ROOT . '/app/libs/DBConnection.php';

$controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Controller trang chủ
if ($controller == 'home') {

    require_once APP_ROOT . '/app/controllers/HomeController.php';

    $homeController = new HomeController();

    if ($action == 'index') {
        $homeController->index();
    } else {
        echo 'Không tìm thấy chức năng trang chủ.';
    }

// Controller quản lý món ăn
} else if ($controller == 'dish') {

    require_once APP_ROOT . '/app/controllers/DishController.php';

    $dishController = new DishController();

    if ($action == 'index') {

        $dishController->index();

    } else if ($action == 'add') {

        $dishController->add();

    } else if ($action == 'store') {

        $dishController->store();

    } else if ($action == 'edit') {

        $dishController->edit();

    } else if ($action == 'update') {

        $dishController->update();

    } else if ($action == 'delete') {

        $dishController->delete();

    } else if ($action == 'destroy') {

        $dishController->destroy();

    } else {

        echo 'Không tìm thấy chức năng quản lý món ăn.';
    }

// Controller khác
// Controller lập thực đơn
} else if ($controller == 'menu') {
    require_once APP_ROOT . '/app/controllers/MenuController.php';
    $menuController = new MenuController();
    if ($action == 'index') {
        $menuController->index();
    } else if ($action == 'store') {
        $menuController->store();
    } else if ($action == 'delete') {
        $menuController->delete($_GET['id'] ?? null);
    } else {
        echo 'Không tìm thấy chức năng lập thực đơn.';
    }

// Controller khác

} else if ($controller == 'user') {
    require_once APP_ROOT . '/app/controllers/UserController.php';
    $userCtrl = new UserController();
    
    if ($action == 'login') {
        $userCtrl->login();
    } else if ($action == 'handleLogin') {
        $userCtrl->handleLogin();
    } else if ($action == 'register') {
        $userCtrl->register();
    } else if ($action == 'handleRegister') {
        $userCtrl->handleRegister();
    } else if ($action == 'logout') {
        $userCtrl->logout();
    } 
    else {

    echo 'Không tìm thấy trang yêu cầu.';
}
}