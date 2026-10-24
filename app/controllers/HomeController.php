<?php
require_once APP_ROOT.'/app/services/PatientService.php';
class HomeController{
    public function index(){
        //goi du lieu benh nhan
        $patientService =new PatientService();
        $patients =$patientService->getAllPatients();

        include APP_ROOT.'/app//views/home/index.php';
    }
}
?>