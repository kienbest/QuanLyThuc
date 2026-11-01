<?php
require_once APP_ROOT . '/app/models/Menu.php';

class MenuService
{
    public function getAllDishes($maNguoiDung)
    {
        $conn = (new DBConnection())->getConnection();
        $sql = "SELECT * FROM mon_an WHERE ma_nguoi_dung = :ma_nguoi_dung";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':ma_nguoi_dung' => $maNguoiDung]);

        $monAn = [];
        while ($row = $stmt->fetch()) {
            $monAn[] = $row;
        }

        return $monAn;
    }

    public function getMenuByDate($ngayAn, $maNguoiDung)
    {
        $conn = (new DBConnection())->getConnection();
        $sql = "SELECT td.*, ma.ten_mon_an
                FROM thuc_don td
                INNER JOIN mon_an ma
                    ON ma.ma_mon_an = td.ma_mon_an
                    AND ma.ma_nguoi_dung = td.ma_nguoi_dung
                WHERE td.ngay_an = :ngay_an
                  AND td.ma_nguoi_dung = :ma_nguoi_dung";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':ngay_an' => $ngayAn,
            ':ma_nguoi_dung' => $maNguoiDung
        ]);

        $thucDon = [];
        while ($row = $stmt->fetch()) {
            $thucDon[] = $row;
        }

        return $thucDon;
    }

    public function saveMenu($ngayAn, $thucDon, $maNguoiDung)
    {
        $conn = (new DBConnection())->getConnection();
        if (!is_array($thucDon)) {
            return;
        }

        $checkDish = $conn->prepare(
            "SELECT 1 FROM mon_an
             WHERE ma_mon_an = :ma_mon_an
               AND ma_nguoi_dung = :ma_nguoi_dung"
        );
        $insertMenu = $conn->prepare(
            "INSERT INTO thuc_don (ma_nguoi_dung, ma_mon_an, ngay_an, bua_an)
             VALUES (:ma_nguoi_dung, :ma_mon_an, :ngay_an, :bua_an)"
        );

        foreach ($thucDon as $buaAn => $monAn) {
            foreach ((array) $monAn as $maMonAn) {
                if ($maMonAn === '') {
                    continue;
                }

                $checkDish->execute([
                    ':ma_mon_an' => $maMonAn,
                    ':ma_nguoi_dung' => $maNguoiDung
                ]);

                if ($checkDish->fetchColumn()) {
                    $insertMenu->execute([
                        ':ma_nguoi_dung' => $maNguoiDung,
                        ':ma_mon_an' => $maMonAn,
                        ':ngay_an' => $ngayAn,
                        ':bua_an' => $buaAn
                    ]);
                }
            }
        }
    }

    public function deleteMenu($maThucDon, $maNguoiDung)
    {
        $dbConnection = new DBConnection();
        $conn = $dbConnection->getConnection();
        if ($conn != null) {
            $sql = "DELETE FROM thuc_don
                    WHERE ma_thuc_don = :ma_thuc_don
                      AND ma_nguoi_dung = :ma_nguoi_dung";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':ma_thuc_don' => $maThucDon,
                ':ma_nguoi_dung' => $maNguoiDung
            ]);
        }
    }
}
?>