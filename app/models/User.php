<?php
class User {
    private $ma_nguoi_dung;
    private $ho_ten;
    private $ten_dang_nhap;
    private $email;
    private $mat_khau;

    // Hàm khởi tạo (Constructor)
    public function __construct($ma_nguoi_dung, $ho_ten, $ten_dang_nhap, $email, $mat_khau) {
        $this->ma_nguoi_dung = $ma_nguoi_dung;
        $this->ho_ten = $ho_ten;
        $this->ten_dang_nhap = $ten_dang_nhap;
        $this->email = $email;
        $this->mat_khau = $mat_khau;
    }

    // Các hàm Getter để lấy dữ liệu
    public function getMaNguoiDung() {
        return $this->ma_nguoi_dung;
    }

    public function getHoTen() {
        return $this->ho_ten;
    }

    public function getTenDangNhap() {
        return $this->ten_dang_nhap;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getMatKhau() {
        return $this->mat_khau;
    }

    // Các hàm Setter (nếu cần thay đổi thông tin)
    public function setHoTen($ho_ten) {
        $this->ho_ten = $ho_ten;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setMatKhau($mat_khau) {
        $this->mat_khau = $mat_khau;
    }
}