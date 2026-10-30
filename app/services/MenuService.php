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
        $maNguoiDung = $_SESSION['user']['id'];
        foreach ($thucDon as $buaAn => $monAn) {
            if (is_array($monAn)) {
                foreach ($monAn as $maMonAn) {
                    $conn->exec("INSERT INTO thuc_don (ma_nguoi_dung, ma_mon_an, ngay_an, bua_an) VALUES ('$maNguoiDung', '$maMonAn', '$ngayAn', '$buaAn')");
                }
            } elseif ($monAn != '') {
                $conn->exec("INSERT INTO thuc_don (ma_nguoi_dung, ma_mon_an, ngay_an, bua_an) VALUES ('$maNguoiDung', '$monAn', '$ngayAn', '$buaAn')");
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
}
?>