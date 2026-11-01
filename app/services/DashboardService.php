
<?php

require_once APP_ROOT . '/app/libs/DBConnection.php';

class DashboardService
{
    private $conn;

    public function __construct()
    {
        $db = new DBConnection();
        $this->conn = $db->getConnection();
    }

    public function getTotalDishes($maNguoiDung)
    {
        $sql = "SELECT COUNT(*) AS total FROM mon_an WHERE ma_nguoi_dung = :ma_nguoi_dung";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':ma_nguoi_dung' => $maNguoiDung]);

        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getTodayMenuCount($maNguoiDung)
    {
        $sql = "SELECT COUNT(*) AS total
                FROM thuc_don
                WHERE ngay_an = CURDATE()
                  AND ma_nguoi_dung = :ma_nguoi_dung";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':ma_nguoi_dung' => $maNguoiDung]);

        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getTotalMenuDays($maNguoiDung)
    {
        $sql = "SELECT COUNT(DISTINCT ngay_an) AS total
                FROM thuc_don
                WHERE ma_nguoi_dung = :ma_nguoi_dung";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':ma_nguoi_dung' => $maNguoiDung]);

        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getMenuByDate($date, $maNguoiDung)
    {
        $sql = "SELECT
                    td.bua_an,
                    ma.ten_mon_an,
                    ma.nguyen_lieu,
                    ma.cach_che_bien,
                    td.ngay_an
                FROM thuc_don td
                INNER JOIN mon_an ma
                    ON ma.ma_mon_an = td.ma_mon_an
                    AND ma.ma_nguoi_dung = td.ma_nguoi_dung
                WHERE td.ngay_an = :ngay_an
                  AND td.ma_nguoi_dung = :ma_nguoi_dung
                ORDER BY FIELD(td.bua_an, 'Sang', 'Trua', 'Toi')";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':ngay_an' => $date,
            ':ma_nguoi_dung' => $maNguoiDung
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMenuHistory($maNguoiDung)
    {
        $sql = "SELECT
                    td.ngay_an,
                    td.bua_an,
                    ma.ten_mon_an,
                    ma.nguyen_lieu,
                    ma.cach_che_bien
                FROM thuc_don td
                INNER JOIN mon_an ma
                    ON ma.ma_mon_an = td.ma_mon_an
                    AND ma.ma_nguoi_dung = td.ma_nguoi_dung
                WHERE td.ma_nguoi_dung = :ma_nguoi_dung
                ORDER BY td.ngay_an DESC,
                         FIELD(td.bua_an, 'Sang', 'Trua', 'Toi')";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':ma_nguoi_dung' => $maNguoiDung]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $history = [];

        foreach ($rows as $row) {
            $history[$row['ngay_an']][] = $row;
        }

        return $history;
    }

       }
?>
