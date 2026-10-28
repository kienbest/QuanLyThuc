<?php
require_once APP_ROOT . '/app/models/Menu.php';

class MenuService
{
    public function getAllDishes()
    {
        $conn = (new DBConnection())->getConnection();
        $sql = "SELECT * FROM mon_an";
        $stmt = $conn->query($sql);

        $monAn = [];
        while ($row = $stmt->fetch()) {
            $monAn[] = $row;
        }

        return $monAn;
    }

    public function getMenuByDate($ngayAn)
    {
        $conn = (new DBConnection())->getConnection();
        $sql = "SELECT * FROM thuc_don WHERE ngay_an = '$ngayAn'";
        $stmt = $conn->query($sql);

        $thucDon = [];
        while ($row = $stmt->fetch()) {
            $mon = $conn->query("SELECT ten_mon_an FROM mon_an WHERE ma_mon_an = " . $row['ma_mon_an'])->fetch();
            $row['ten_mon_an'] = $mon['ten_mon_an'];
            $thucDon[] = $row;
        }

        return $thucDon;
    }

    public function saveMenu($ngayAn, $thucDon)
    {
        $conn = (new DBConnection())->getConnection();

        foreach ($thucDon as $buaAn => $monAn) {
            if (is_array($monAn)) {
                foreach ($monAn as $maMonAn) {
                    $conn->exec("INSERT INTO thuc_don (ma_nguoi_dung, ma_mon_an, ngay_an, bua_an) VALUES (1, '$maMonAn', '$ngayAn', '$buaAn')");
                }
            } elseif ($monAn != '') {
                $conn->exec("INSERT INTO thuc_don (ma_nguoi_dung, ma_mon_an, ngay_an, bua_an) VALUES (1, '$monAn', '$ngayAn', '$buaAn')");
            }
        }
    }

    public function deleteMenu($maThucDon)
    {
        $dbConnection = new DBConnection();
        $conn = $dbConnection->getConnection();
        if ($conn != null) {
            $sql = "DELETE FROM thuc_don WHERE ma_thuc_don = '$maThucDon'";
            $conn->exec($sql);
        }
    }

    // ===== Tra cứu thực đơn =====

    private $meals = ['Sang', 'Trua', 'Toi'];

    private function emptyMeals()
    {
        $result = [];
        foreach ($this->meals as $meal) {
            $result[$meal] = [];
        }
        return $result;
    }

    // Thực đơn của một ngày, gom theo bữa (mỗi bữa có thể có nhiều món)
    public function getMenuByMeal($date)
    {
        $result = $this->emptyMeals();
        $conn = (new DBConnection())->getConnection();
        if ($conn == null) {
            return $result;
        }
        $stmt = $conn->prepare("SELECT td.bua_an, ma.ten_mon_an
                FROM thuc_don td
                LEFT JOIN mon_an ma ON ma.ma_mon_an = td.ma_mon_an
                WHERE td.ngay_an = :ngay_an");
        $stmt->bindValue(':ngay_an', $date);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (isset($result[$row['bua_an']]) && $row['ten_mon_an'] !== null) {
                $result[$row['bua_an']][] = $row['ten_mon_an'];
            }
        }
        return $result;
    }

    // Số ngày đã có thực đơn trong quá khứ (dùng để chia trang)
    public function countHistoryDays()
    {
        $conn = (new DBConnection())->getConnection();
        if ($conn == null) {
            return 0;
        }
        $stmt = $conn->query("SELECT COUNT(DISTINCT ngay_an) AS total
                FROM thuc_don WHERE ngay_an < CURDATE()");
        return (int) $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Lịch sử thực đơn: mỗi ngày một dòng, mới nhất ở trên
    public function getHistory($limit, $offset)
    {
        $conn = (new DBConnection())->getConnection();
        if ($conn == null) {
            return [];
        }
        $stmt = $conn->prepare("SELECT DISTINCT ngay_an FROM thuc_don
                WHERE ngay_an < CURDATE()
                ORDER BY ngay_an DESC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $stmt->execute();
        $dates = $stmt->fetchAll(PDO::FETCH_COLUMN);
        if (empty($dates)) {
            return [];
        }

        $placeholders = implode(',', array_fill(0, count($dates), '?'));
        $stmt = $conn->prepare("SELECT td.ngay_an, td.bua_an, ma.ten_mon_an
                FROM thuc_don td
                LEFT JOIN mon_an ma ON ma.ma_mon_an = td.ma_mon_an
                WHERE td.ngay_an IN ($placeholders)
                ORDER BY td.ngay_an DESC");
        $stmt->execute($dates);

        $history = [];
        foreach ($dates as $date) {
            $history[$date] = $this->emptyMeals();
        }
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (isset($history[$row['ngay_an']][$row['bua_an']]) && $row['ten_mon_an'] !== null) {
                $history[$row['ngay_an']][$row['bua_an']][] = $row['ten_mon_an'];
            }
        }
        return $history;
    }
}
