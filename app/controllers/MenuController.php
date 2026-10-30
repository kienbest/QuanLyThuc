
<?php

require_once APP_ROOT . '/app/services/MenuService.php';
require_once APP_ROOT . '/app/services/DashboardService.php';

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
        }

        echo 'Id is null';
    }

    public function destroy($maThucDon)
    {
        $menuService = new MenuService();
        $menuService->deleteMenu($maThucDon);

        header('Location: ?controller=menu&action=index');
        exit;
    }

    public function history()
    {
        if (!isset($_SESSION['user'])) {
            echo "<script>
                alert('Bạn cần đăng nhập để tra cứu thực đơn!');
                window.location.href = '" . DOMAIN . "public/?controller=user&action=login';
            </script>";
            exit;
        }
        $dashboardService = new DashboardService();

        $selectedDate = $_GET['date'] ?? date('Y-m-d');

        $mealNames = [
            'Sang' => 'Bữa sáng',
            'Trua' => 'Bữa trưa',
            'Toi'  => 'Bữa tối'
        ];

        $menuByDate = $dashboardService->getMenuByDate($selectedDate);

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

        $historyData = $dashboardService->getMenuHistory();
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
