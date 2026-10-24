<?php

require_once('../app/config/config.php');
require_once APP_ROOT . '/app/libs/DBConnection.php';

$controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

if ($controller == 'home') {

    require_once APP_ROOT . '/app/controllers/HomeController.php';

    $homeController = new HomeController();
    $homeController->index();

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
    }else if ($action == 'update') {
        $dishController->update();
    }else if ($action == 'delete') {
    $dishController->delete();
}else if ($action == 'destroy') {
    $dishController->destroy();
}

} else {
    echo 'Nothing';
}