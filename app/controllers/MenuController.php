
<?php

require_once APP_ROOT . '/app/services/MenuService.php';
require_once APP_ROOT . '/app/services/DashboardService.php';

class MenuController
{
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
        $menuService = new MenuService();
        $ngayAn = $_GET['ngay_an'] ?? date('Y-m-d');
        $monAn = $menuService->getAllDishes($maNguoiDung);
        $thucDon = $menuService->getMenuByDate($ngayAn, $maNguoiDung);

        include APP_ROOT . '/app/views/menu/index.php';
    }

    public function store()
    {
        $maNguoiDung = $this->checkLogin();
        $ngayAn = $_POST['ngay_an'] ?? '';
        $thucDon = $_POST['thuc_don'] ?? [];

        $menuService = new MenuService();
        $menuService->saveMenu($ngayAn, $thucDon, $maNguoiDung);

        header('Location: ?controller=menu&action=index&ngay_an=' . $ngayAn);
        exit;
    }

    public function delete($maThucDon)
    {
        $maNguoiDung = $this->checkLogin();
        if (isset($maThucDon)) {
            $menuService = new MenuService();
            $menuService->deleteMenu($maThucDon, $maNguoiDung);

            $ngayAn = $_GET['ngay_an'] ?? date('Y-m-d');
            header('Location: ?controller=menu&action=index&ngay_an=' . $ngayAn);
            exit;
        }

        echo 'Id is null';
    }

    public function destroy($maThucDon)
    {
        $maNguoiDung = $this->checkLogin();
        $menuService = new MenuService();
        $menuService->deleteMenu($maThucDon, $maNguoiDung);

        header('Location: ?controller=menu&action=index');
        exit;
    }

    public function history()
    {
        $maNguoiDung = $this->checkLogin();
        $dashboardService = new DashboardService();

        $selectedDate = $_GET['date'] ?? date('Y-m-d');

        $mealNames = [
            'Sang' => 'Bữa sáng',
            'Trua' => 'Bữa trưa',
            'Toi'  => 'Bữa tối'
        ];

        $menuByDate = $dashboardService->getMenuByDate($selectedDate, $maNguoiDung);

        $selectedMenu = [
            'Sang' => [],
            'Trua' => [],
            'Toi'  => []
        ];

        foreach ($menuByDate as $meal) {
            $key = $meal['bua_an'];

            if (isset($selectedMenu[$key])) {
                $selectedMenu[$key][] = $meal['ten_mon_an'];
            }
        }

        $historyData = $dashboardService->getMenuHistory($maNguoiDung);
        $history = [];

        foreach ($historyData as $date => $meals) {
            foreach ($meals as $meal) {
                $key = $meal['bua_an'];

                if (!isset($history[$date])) {
                    $history[$date] = [
                        'Sang' => [],
                        'Trua' => [],
                        'Toi' => []
                    ];
                }

                if (isset($history[$date][$key]) && !empty($meal['ten_mon_an'])) {
                    $history[$date][$key][] = $meal['ten_mon_an'];
                }
            }
        }

        $page = max(1, (int) ($_GET['page'] ?? 1));
        $totalPages = 1;

        include APP_ROOT . '/app/views/menu/history.php';
    }
}
?>
