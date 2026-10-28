<?php
require_once APP_ROOT . '/app/libs/DBConnection.php';

class UserService {
    private $conn;

    public function __construct() {
        $db = new DBConnection();
        $this->conn = $db->getConnection();
    }

    // Kiểm tra xem tên đăng nhập đã tồn tại chưa (dùng cột ten_dang_nhap)
    public function checkUserExists($ten_dang_nhap) {
        $sql = "SELECT * FROM nguoi_dung WHERE ten_dang_nhap = :ten_dang_nhap";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':ten_dang_nhap', $ten_dang_nhap);
        $stmt->execute();
        return $stmt->fetch() ? true : false;
    }

    // Đăng ký tài khoản mới khớp với các cột trong DB của bạn
    public function register($ten_dang_nhap, $mat_khau, $ho_ten, $email) {
        $hashedPassword = password_hash($mat_khau, PASSWORD_BCRYPT);
        
        $sql = "INSERT INTO nguoi_dung (ten_dang_nhap, mat_khau, ho_ten, email) VALUES (:ten_dang_nhap, :mat_khau, :ho_ten, :email)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':ten_dang_nhap' => $ten_dang_nhap,
            ':mat_khau'      => $hashedPassword,
            ':ho_ten'        => $ho_ten,
            ':email'         => $email
        ]);
    }

    // Đăng nhập (kiểm tra ten_dang_nhap và mat_khau)
    public function login($ten_dang_nhap, $mat_khau) {
        $sql = "SELECT * FROM nguoi_dung WHERE ten_dang_nhap = :ten_dang_nhap";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':ten_dang_nhap', $ten_dang_nhap);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($mat_khau, $row['mat_khau'])) {
            return $row;
        }
        return false;
    }
}
?>