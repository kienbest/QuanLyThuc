<?php
require_once APP_ROOT.'/app/models/Patient.php';

class PatientService{
    public function getAllPatients(){
        $patients = [];
        $dbConnection = new DBConnection();

        if ($dbConnection != null) {
            $conn = $dbConnection->getConnection();

            if ($conn != null) {
                $sql = "SELECT * FROM sinhvien";
                $stmt = $conn->query($sql);

                while ($row = $stmt->fetch()) {
                    $patient = new Patient($row['masv'], $row['tensv'], $row['lop'], $row['khoa']);
                    $patients[] = $patient;
                }

                return $patients;
            }
        }

        return [];
    }

    public function addPatient($masv, $tensv, $lop, $khoa){
        $dbConnection = new DBConnection();
        $conn = $dbConnection->getConnection();

        $sql = "INSERT INTO sinhvien (masv,tensv,lop,khoa) VALUES (?, ?, ?,?)";
        $stmt = $conn->prepare($sql);

        return $stmt->execute([$masv, $tensv, $lop, $khoa]);
    }

    public function editPatient($masv, $tensv, $lop, $khoa){
        $dbConnection = new DBConnection();
        $conn = $dbConnection->getConnection();

        $sql = "UPDATE sinhvien SET tensv = ?, lop = ?, khoa = ? WHERE masv = ?";
        $stmt = $conn->prepare($sql);

        return $stmt->execute([$tensv, $lop, $khoa, $masv]);
    }

    public function deletePatient($masv){
        $dbConnection = new DBConnection();
        $conn = $dbConnection->getConnection();

        $sql = "DELETE FROM sinhvien WHERE masv = ?";
        $stmt = $conn->prepare($sql);

        return $stmt->execute([$masv]);
    }

    public function getPatientById($masv){
        $dbConnection = new DBConnection();
        $conn = $dbConnection->getConnection();

        $sql = "SELECT * FROM sinhvien WHERE masv = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$masv]);

        $row = $stmt->fetch();

        if ($row) {
            return new Patient(
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