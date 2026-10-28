<!--?php
class Menu
{
    private $maThucDon;
    private $maNguoiDung;
    private $maMonAn;
    private $ngayAn;
    private $buaAn;

    public function __construct($maThucDon, $maNguoiDung, $maMonAn, $ngayAn, $buaAn)
    {
        $this->maThucDon = $maThucDon;
        $this->maNguoiDung = $maNguoiDung;
        $this->maMonAn = $maMonAn;
        $this->ngayAn = $ngayAn;
        $this->buaAn = $buaAn;
    }

    public function getMaThucDon()
    {
        return $this->maThucDon;
    }

    public function getMaNguoiDung()
    {
        return $this->maNguoiDung;
    }

    public function getMaMonAn()
    {
        return $this->maMonAn;
    }

    public function getNgayAn()
    {
        return $this->ngayAn;
    }

    public function getBuaAn()
    {
        return $this->buaAn;
    }
}
?>-->
<?php
class Menu
{
    private $ma_thuc_don;
    private $ma_nguoi_dung;
    private $ma_mon_an;
    private $ngay_an;
    private $bua_an;

    public function __construct($ma_thuc_don, $ma_nguoi_dung, $ma_mon_an, $ngay_an, $bua_an)
    {
        $this->ma_thuc_don = $ma_thuc_don;
        $this->ma_nguoi_dung = $ma_nguoi_dung;
        $this->ma_mon_an = $ma_mon_an;
        $this->ngay_an = $ngay_an;
        $this->bua_an = $bua_an;
    }

    public function getMa_thuc_don()
    {
        return $this->ma_thuc_don;
    }

    public function getMa_nguoi_dung()
    {
        return $this->ma_nguoi_dung;
    }

    public function getMa_mon_an()
    {
        return $this->ma_mon_an;
    }

    public function getNgay_an()
    {
        return $this->ngay_an;
    }

    public function getBua_an()
    {
        return $this->bua_an;
    }
}
?>