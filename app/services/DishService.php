
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
                $ma_mon_an = $dish->getMa_mon_an();
                $ma_nguoi_dung = $dish->getMa_nguoi_dung();
                $ten_mon_an = $dish->getTen_mon_an();
                $nguyen_lieu = $dish->getNguyen_lieu();
                $cach_che_bien = $dish->getCach_che_bien();

                $sql = "INSERT INTO mon_an (`ma_mon_an`, `ma_nguoi_dung`, `ten_mon_an`, `nguyen_lieu`, `cach_che_bien`)
                        VALUES ('$ma_mon_an', '$ma_nguoi_dung', '$ten_mon_an', '$nguyen_lieu', '$cach_che_bien')";

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
                $sql = "SELECT * FROM mon_an WHERE `ma_mon_an` = '$ma_mon_an'";
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
                $ma_mon_an = $dish->getMa_mon_an();
                $ma_nguoi_dung = $dish->getMa_nguoi_dung();
                $ten_mon_an = $dish->getTen_mon_an();
                $nguyen_lieu = $dish->getNguyen_lieu();
                $cach_che_bien = $dish->getCach_che_bien();

                $sql = "UPDATE mon_an
                        SET 
                            `ma_mon_an` = '$ma_mon_an',
                            `ma_nguoi_dung` = '$ma_nguoi_dung',
                            `ten_mon_an` = '$ten_mon_an',
                            `nguyen_lieu` = '$nguyen_lieu',
                            `cach_che_bien` = '$cach_che_bien'
                        WHERE `ma_mon_an` = '$ma_mon_an'";

                $conn->exec($sql);
            }
        }
    }

    public function deleteDish($ma_mon_an)
    {
        $dbConnection = new DBConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $sql = "DELETE FROM mon_an WHERE `ma_mon_an` = '$ma_mon_an'";
                $conn->exec($sql);
            }
        }
    }
}
?>
