
<?php

require_once APP_ROOT . '/app/models/Dish.php';

class DishService
{
    public function getAllDishes()
    {
        $dishes = [];
        $dbConnection = new DBConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $sql = "SELECT * FROM mon_an";
                $stmt = $conn->query($sql);

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

    public function addDish(Dish $dish)
    {
        $dbConnection = new DBConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $maNguoiDung = $dish->getMaNguoiDung();
                $tenMonAn = $dish->getTenMonAn();
                $nguyenLieu = $dish->getNguyenLieu();
                $cachCheBien = $dish->getCachCheBien();

                $sql = "INSERT INTO mon_an (`ma_nguoi_dung`, `ten_mon_an`, `nguyen_lieu`, `cach_che_bien`)
                        VALUES ('$maNguoiDung', '$tenMonAn', '$nguyenLieu', '$cachCheBien')";

                $conn->exec($sql);
            }
        }
    }

    public function getDishById($maMonAn)
    {
        $dbConnection = new DBConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $sql = "SELECT * FROM mon_an WHERE `ma_mon_an` = '$maMonAn'";
                $stmt = $conn->query($sql);

                if ($stmt->rowCount() > 0) {
                    $row = $stmt->fetch();

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

    public function editDish(Dish $dish)
    {
        $dbConnection = new DBConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $maMonAn = $dish->getMaMonAn();
                $maNguoiDung = $dish->getMaNguoiDung();
                $tenMonAn = $dish->getTenMonAn();
                $nguyenLieu = $dish->getNguyenLieu();
                $cachCheBien = $dish->getCachCheBien();

                $sql = "UPDATE mon_an
                        SET `ma_nguoi_dung` = '$maNguoiDung',
                            `ten_mon_an` = '$tenMonAn',
                            `nguyen_lieu` = '$nguyenLieu',
                            `cach_che_bien` = '$cachCheBien'
                        WHERE `ma_mon_an` = '$maMonAn'";

                $conn->exec($sql);
            }
        }
    }

    public function deleteDish($maMonAn)
    {
        $dbConnection = new DBConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $sql = "DELETE FROM mon_an WHERE `ma_mon_an` = '$maMonAn'";
                $conn->exec($sql);
            }
        }
    }
}
?>
