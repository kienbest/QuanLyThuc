<?php
class Patient{
    private $masv;
    private $tensv;
    private $lop;
    private $khoa;
    
    

    public function __construct($masv, $tensv, $lop, $khoa)
    {
        $this->masv = $masv;
        $this->tensv = $tensv;
        $this->lop = $lop;
        $this->khoa = $khoa;
    }

    public function getMaSv(){
        return $this->masv;
    }

    public function getTenSv(){
        return $this->tensv;
    }
    public function getLop(){
        return $this->lop;
    }

    public function getKhoa(){
        return $this->khoa;
    }
}
?>