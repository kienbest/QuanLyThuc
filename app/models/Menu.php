<?php
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
?>