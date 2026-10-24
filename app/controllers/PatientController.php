
<?php
require_once APP_ROOT.'/app/services/PatientService.php';

class PatientController {

    public function redirect() {
        header('Location: '.DOMAIN.'public/');
        exit;
    }

    public function index() {
        $patientService = new PatientService();
        $patients = $patientService->getAllPatients();

        include APP_ROOT.'/app/views/home/index.php';
    }

    public function add() {
        include APP_ROOT.'/app/views/patient/add.php';
    }

    public function store() {
        $masv = $_POST['masv'] ?? '';
        $tensv = $_POST['tensv'] ?? '';
        $lop = $_POST['lop'] ?? '';
        $khoa = $_POST['khoa'] ?? '';

        $patientService = new PatientService();
        $patientService->addPatient($masv, $tensv, $lop, $khoa);

        $this->redirect();
    }

    public function edit() {
        $MaSv = $_GET['MaSv'] ?? '';

        $patientService = new PatientService();
        $patient = $patientService->getPatientById($MaSv);

        include APP_ROOT.'/app/views/patient/edit.php';
    }

    public function update() {
        $MaSv = $_POST['masv'] ?? '';
        $TenSv = $_POST['tensv'] ?? '';
        $Lop = $_POST['lop'] ?? '';
        $Khoa = $_POST['khoa'] ?? '';

        $patientService = new PatientService();
        $patientService->editPatient($MaSv, $TenSv, $Lop, $Khoa);

        $this->redirect();
    }

    public function delete() {
        $masv = $_GET['MaSv'] ?? '';

        $patientService = new PatientService();
        $patientService->deletePatient($masv);

        $this->redirect();
    }

    public function destroy() {
        $masv = $_POST['masv'] ?? '';

        $patientService = new PatientService();
        $patientService->deletePatient($masv);

        $this->redirect();
    }
}
?>
