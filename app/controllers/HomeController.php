<?php

require_once APP_ROOT . '/app/services/DashboardService.php';

class HomeController
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

        // Khởi tạo service
        $dashboardService = new DashboardService();

        // 1. Lấy dữ liệu thống kê
        $totalDishes = $dashboardService->getTotalDishes($maNguoiDung);

        $todayMenuCount = $dashboardService->getTodayMenuCount($maNguoiDung);

        $totalMenuDays = $dashboardService->getTotalMenuDays($maNguoiDung);

        // 2. Lấy ngày cần tra cứu
        $selectedDate = $_GET['date'] ?? date('Y-m-d');

        // Kiểm tra định dạng ngày
        $dateObject = DateTime::createFromFormat(
            '!Y-m-d',
            $selectedDate
        );

        if (
            !$dateObject ||
            $dateObject->format('Y-m-d') !== $selectedDate
        ) {
            $selectedDate = date('Y-m-d');
        }

        // 3. Lấy thực đơn hôm nay
        $todayMenu = $dashboardService->getMenuByDate(
            date('Y-m-d'),
            $maNguoiDung
        );

        // 4. Lấy thực đơn theo ngày được chọn
        $historyMenu = $dashboardService->getMenuByDate(
            $selectedDate,
            $maNguoiDung
        );

        // 5. Tên các bữa ăn
        $mealNames = [
            'Sang' => 'Sáng',
            'Trua' => 'Trưa',
            'Toi' => 'Tối'
        ];

   

        // 7. Mở giao diện
        require APP_ROOT . '/app/views/home/index.php';
    }
}