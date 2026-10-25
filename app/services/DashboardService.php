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

 
    public function getTotalDishes()
    {
        $sql = "SELECT COUNT(*) AS total FROM mon_an";
        $stmt = $this->conn->query($sql);

        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    
    public function getTodayMenuCount()
    {
        $sql = "SELECT COUNT(*) AS total
                FROM thuc_don
                WHERE ngay_an = CURDATE()";

        $stmt = $this->conn->query($sql);

        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }


    public function getTotalMenuDays()
    {
        $sql = "SELECT COUNT(DISTINCT ngay_an) AS total
                FROM thuc_don";

        $stmt = $this->conn->query($sql);

        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

   
        public function getMenuByDate($date)
        {
            $sql = "SELECT
                        td.bua_an,
                        (
                            SELECT ma.ten_mon_an
                            FROM mon_an ma
                            WHERE ma.ma_mon_an = td.ma_mon_an
                        ) AS ten_mon_an,
                        td.ngay_an
                    FROM thuc_don td
                    WHERE td.ngay_an = :ngay_an
                    ORDER BY FIELD(td.bua_an, 'Sang', 'Trua', 'Toi')";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':ngay_an', $date);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
}