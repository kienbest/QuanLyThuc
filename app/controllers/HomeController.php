<?php

require_once APP_ROOT . '/app/services/DashboardService.php';

class HomeController
{
    public function index()
    {
        // Khởi tạo service
        $dashboardService = new DashboardService();

        // 1. Lấy dữ liệu thống kê
        $totalDishes = $dashboardService->getTotalDishes();

        $todayMenuCount = $dashboardService->getTodayMenuCount();

        $totalMenuDays = $dashboardService->getTotalMenuDays();

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
            date('Y-m-d')
        );

        // 4. Lấy thực đơn theo ngày được chọn
        $historyMenu = $dashboardService->getMenuByDate(
            $selectedDate
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