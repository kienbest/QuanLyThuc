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

    // Tra cứu thực đơn theo ngày + lịch sử thực đơn
    public function history()
    {
        $menuService = new MenuService();

        $selectedDate = $_GET['date'] ?? date('Y-m-d');
        $dateObject = DateTime::createFromFormat('!Y-m-d', $selectedDate);
        if (!$dateObject || $dateObject->format('Y-m-d') !== $selectedDate) {
            $selectedDate = date('Y-m-d');
        }

        $selectedMenu = $menuService->getMenuByMeal($selectedDate);

        $perPage = 5;
        $page = max(1, (int) ($_GET['page'] ?? 1));
        $totalDays = $menuService->countHistoryDays();
        $totalPages = max(1, (int) ceil($totalDays / $perPage));
        if ($page > $totalPages) {
            $page = $totalPages;
        }
        $history = $menuService->getHistory($perPage, ($page - 1) * $perPage);

        $mealNames = ['Sang' => 'Bữa sáng', 'Trua' => 'Bữa trưa', 'Toi' => 'Bữa tối'];

        require APP_ROOT . '/app/views/menu/history.php';
    }
}
