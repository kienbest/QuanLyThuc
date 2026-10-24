<?php

require_once('../app/config/config.php');
require_once APP_ROOT . '/app/libs/DBConnection.php';

$controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

if ($controller == 'home') {

    require_once APP_ROOT . '/app/controllers/HomeController.php';

    $homeController = new HomeController();
    $homeController->index();

} else if ($controller == 'patient') {

    require_once APP_ROOT . '/app/controllers/PatientController.php';

    $patientController = new PatientController();

    if ($action == 'index') {
        $patientController->index();

    } else if ($action == 'add') {
        $patientController->add();

    } else if ($action == 'store') {
        $patientController->store();

    } else if ($action == 'edit') {
        $patientController->edit();
    }else if ($action == 'update') {
        $patientController->update();
    }else if ($action == 'delete') {
    $patientController->delete();
}else if ($action == 'destroy') {
    $patientController->destroy();
}

} else {
    echo 'Nothing';
}