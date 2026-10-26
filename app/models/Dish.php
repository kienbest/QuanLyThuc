<?php

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
?>