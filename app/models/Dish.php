<!--?
php

class Dish
{
    private $maMonAn;
    private $maNguoiDung;
    private $tenMonAn;
    private $nguyenLieu;
    private $cachCheBien;

    public function __construct($maMonAn, $maNguoiDung, $tenMonAn, $nguyenLieu, $cachCheBien)
    {
        $this->maMonAn = $maMonAn;
        $this->maNguoiDung = $maNguoiDung;
        $this->tenMonAn = $tenMonAn;
        $this->nguyenLieu = $nguyenLieu;
        $this->cachCheBien = $cachCheBien;
    }

    public function getMaMonAn()
    {
        return $this->maMonAn;
    }

    public function getMaNguoiDung()
    {
        return $this->maNguoiDung;
    }

    public function getTenMonAn()
    {
        return $this->tenMonAn;
    }

    public function getNguyenLieu()
    {
        return $this->nguyenLieu;
    }

    public function getCachCheBien()
    {
        return $this->cachCheBien;
    }

    public function setMaNguoiDung($maNguoiDung)
    {
        $this->maNguoiDung = $maNguoiDung;
    }

    public function setTenMonAn($tenMonAn)
    {
        $this->tenMonAn = $tenMonAn;
    }

    public function setNguyenLieu($nguyenLieu)
    {
        $this->nguyenLieu = $nguyenLieu;
    }

    public function setCachCheBien($cachCheBien)
    {
        $this->cachCheBien = $cachCheBien;
    }
}
?>-->
<?php

class Dish
{
    private $ma_mon_an;
    private $ma_nguoi_dung;
    private $ten_mon_an;
    private $nguyen_lieu;
    private $cach_che_bien;

    public function __construct($ma_mon_an, $ma_nguoi_dung, $ten_mon_an, $nguyen_lieu, $cach_che_bien)
    {
        $this->ma_mon_an = $ma_mon_an;
        $this->ma_nguoi_dung = $ma_nguoi_dung;
        $this->ten_mon_an = $ten_mon_an;
        $this->nguyen_lieu = $nguyen_lieu;
        $this->cach_che_bien = $cach_che_bien;
    }

    public function getMa_mon_an()
    {
        return $this->ma_mon_an;
    }

    public function getMa_nguoi_dung()
    {
        return $this->ma_nguoi_dung;
    }

    public function getTen_mon_an()
    {
        return $this->ten_mon_an;
    }

    public function getNguyen_lieu()
    {
        return $this->nguyen_lieu;
    }

    public function getCach_che_bien()
    {
        return $this->cach_che_bien;
    }

    public function setMa_nguoi_dung($ma_nguoi_dung)
    {
        $this->ma_nguoi_dung = $ma_nguoi_dung;
    }

    public function setTen_mon_an($ten_mon_an)
    {
        $this->ten_mon_an = $ten_mon_an;
    }

    public function setNguyen_lieu($nguyen_lieu)
    {
        $this->nguyen_lieu = $nguyen_lieu;
    }

    public function setCach_che_bien($cach_che_bien)
    {
        $this->cach_che_bien = $cach_che_bien;
    }
}
?>