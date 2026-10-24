<?php
require_once APP_ROOT.'/app/models/Dish.php';

class DishService{
    public function getAllDishes(){
        $dishes = [];
        $dbConnection = new DBConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $sql = "SELECT * FROM sinhvien";
                $stmt = $conn->query($sql);

                while ($row = $stmt->fetch()) {
                    $dish = new Dish($row['masv'], $row['tensv'], $row['lop'], $row['khoa']);
                    $dishes[] = $dish;
                }

                return $dishes;
            }
        }

        return [];
    }

    public function addDish($masv, $tensv, $lop, $khoa){
        $dbConnection = new DBConnection();
        $conn = $dbConnection->getConnection();

        $sql = "INSERT INTO sinhvien (masv,tensv,lop,khoa) VALUES (?, ?, ?,?)";
        $stmt = $conn->prepare($sql);

        return $stmt->execute([$masv, $tensv, $lop, $khoa]);
    }

    public function editDish($masv, $tensv, $lop, $khoa){
        $dbConnection = new DBConnection();
        $conn = $dbConnection->getConnection();

        $sql = "UPDATE sinhvien SET tensv = ?, lop = ?, khoa = ? WHERE masv = ?";
        $stmt = $conn->prepare($sql);

        return $stmt->execute([$tensv, $lop, $khoa, $masv]);
    }

    public function deleteDish($masv){
        $dbConnection = new DBConnection();
        $conn = $dbConnection->getConnection();

        $sql = "DELETE FROM sinhvien WHERE masv = ?";
        $stmt = $conn->prepare($sql);

        return $stmt->execute([$masv]);
    }

    public function getDishById($masv){
        $dbConnection = new DBConnection();
        $conn = $dbConnection->getConnection();

        $sql = "SELECT * FROM sinhvien WHERE masv = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$masv]);

        $row = $stmt->fetch();

        if ($row) {
            return new Dish(
                $row['masv'],
                $row['tensv'],
                $row['lop'],
                $row['khoa']
            );
        }

        return null;
    }
}
?>