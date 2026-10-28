<?php

require_once APP_ROOT . '/app/services/MenuService.php';

class MenuController
{
    public function index()
    {
        $menuService = new MenuService();
        $ngayAn = $_GET['ngay_an'] ?? date('Y-m-d');
        $monAn = $menuService->getAllDishes();
        $thucDon = $menuService->getMenuByDate($ngayAn);
        include APP_ROOT . '/app/views/menu/index.php';
    }

    public function store()
    {
        $ngayAn = $_POST['ngay_an'];
        $thucDon = $_POST['thuc_don'];
        $menuService = new MenuService();
        $menuService->saveMenu($ngayAn, $thucDon);
        header('Location: ?controller=menu&action=index&ngay_an=' . $ngayAn);
        exit;
    }

    public function delete($maThucDon)
    {
        if (isset($maThucDon)) {
            $menuService = new MenuService();
            $menuService->deleteMenu($maThucDon);
            $ngayAn = $_GET['ngay_an'] ?? date('Y-m-d');
            header('Location: ?controller=menu&action=index&ngay_an=' . $ngayAn);
            exit;
        } else {
            echo 'Id is null';
        }
    }

    public function destroy($maThucDon)
    {
        $menuService = new MenuService();
        $menuService->deleteMenu($maThucDon);
        header('Location: ?controller=menu&action=index');
        exit;
    }
}
?>