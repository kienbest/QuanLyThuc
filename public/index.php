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
    } else if ($action == 'destroy') {
        $menuController->destroy($_GET['id'] ?? null);
    } else if ($action == 'history') {
        $menuController->history();
    } else {
        echo 'Không tìm thấy chức năng lập thực đơn.';
    }

    // Controller tài khoản
} else if ($controller == 'user') {

    require_once APP_ROOT . '/app/controllers/UserController.php';

    $userController = new UserController();

    if ($action == 'login') {
        $userController->login();
    } else if ($action == 'handleLogin') {
        $userController->handleLogin();
    } else if ($action == 'register') {
        $userController->register();
    } else if ($action == 'handleRegister') {
        $userController->handleRegister();
    } else if ($action == 'logout') {
        $userController->logout();
    } else {
        echo 'Không tìm thấy chức năng tài khoản.';
    }
} else {

    echo 'Không tìm thấy trang yêu cầu.';
}
