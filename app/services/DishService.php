
<?php

require_once APP_ROOT . '/app/models/Dish.php';

class DishService
{
    public function getAllDishes($maNguoiDung)
    {
        $dishes = [];
        $dbConnection = new DBConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $sql = "SELECT * FROM mon_an WHERE ma_nguoi_dung = :ma_nguoi_dung";
                $stmt = $conn->prepare($sql);
                $stmt->execute([':ma_nguoi_dung' => $maNguoiDung]);

                while ($row = $stmt->fetch()) {
                    $dish = new Dish(
                        $row['ma_mon_an'],
                        $row['ma_nguoi_dung'],
                        $row['ten_mon_an'],
                        $row['nguyen_lieu'],
                        $row['cach_che_bien']
                    );

                    $dishes[] = $dish;
                }

                return $dishes;
            }
        }

        return $dishes;
    }

    public function addDish(Dish $dish, $maNguoiDung)
    {
        $dbConnection = new DBConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $tenMonAn = $dish->getTenMonAn();
                $nguyenLieu = $dish->getNguyenLieu();
                $cachCheBien = $dish->getCachCheBien();

                $sql = "INSERT INTO mon_an (`ma_nguoi_dung`, `ten_mon_an`, `nguyen_lieu`, `cach_che_bien`)
                        VALUES (:ma_nguoi_dung, :ten_mon_an, :nguyen_lieu, :cach_che_bien)";

                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':ma_nguoi_dung' => $maNguoiDung,
                    ':ten_mon_an' => $tenMonAn,
                    ':nguyen_lieu' => $nguyenLieu,
                    ':cach_che_bien' => $cachCheBien
                ]);
            }
        }
    }

    public function getDishById($maMonAn, $maNguoiDung)
    {
        $dbConnection = new DBConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $sql = "SELECT * FROM mon_an
                        WHERE `ma_mon_an` = :ma_mon_an
                          AND `ma_nguoi_dung` = :ma_nguoi_dung";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':ma_mon_an' => $maMonAn,
                    ':ma_nguoi_dung' => $maNguoiDung
                ]);

                if ($row = $stmt->fetch()) {

                    $dish = new Dish(
                        $row['ma_mon_an'],
                        $row['ma_nguoi_dung'],
                        $row['ten_mon_an'],
                        $row['nguyen_lieu'],
                        $row['cach_che_bien']
                    );

                    return $dish;
                }
            }
        }
    }

    public function editDish(Dish $dish, $maNguoiDung)
    {
        $dbConnection = new DBConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $maMonAn = $dish->getMaMonAn();
                $tenMonAn = $dish->getTenMonAn();
                $nguyenLieu = $dish->getNguyenLieu();
                $cachCheBien = $dish->getCachCheBien();

                $sql = "UPDATE mon_an
                        SET `ten_mon_an` = :ten_mon_an,
                            `nguyen_lieu` = :nguyen_lieu,
                            `cach_che_bien` = :cach_che_bien
                        WHERE `ma_mon_an` = :ma_mon_an
                          AND `ma_nguoi_dung` = :ma_nguoi_dung";

                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':ten_mon_an' => $tenMonAn,
                    ':nguyen_lieu' => $nguyenLieu,
                    ':cach_che_bien' => $cachCheBien,
                    ':ma_mon_an' => $maMonAn,
                    ':ma_nguoi_dung' => $maNguoiDung
                ]);
            }
        }
    }

    public function deleteDish($maMonAn, $maNguoiDung)
    {
        $dbConnection = new DBConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $sql = "DELETE FROM mon_an
                        WHERE `ma_mon_an` = :ma_mon_an
                          AND `ma_nguoi_dung` = :ma_nguoi_dung";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':ma_mon_an' => $maMonAn,
                    ':ma_nguoi_dung' => $maNguoiDung
                ]);
            }
        }
    }
}
?>
