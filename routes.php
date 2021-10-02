<?php

declare(strict_types=1);

$router->get("/department", "Hospital\Department\DepartmentController::getAll");
$router->post("/department", "Hospital\Department\DepartmentController::insert");
$router->group("/department", function ($router) {
    $router->get("/{department_id:number}", "Hospital\Department\DepartmentController::get");
    $router->post("/{department_id:number}", "Hospital\Department\DepartmentController::update");
    $router->delete("/{department_id:number}", "Hospital\Department\DepartmentController::delete");
});

$router->get("/worker", "Hospital\Worker\WorkerController::getAll");
$router->post("/worker", "Hospital\Worker\WorkerController::insert");
$router->group("/worker", function ($router) {
    $router->get("/{worker_id:number}", "Hospital\Worker\WorkerController::get");
    $router->post("/{worker_id:number}", "Hospital\Worker\WorkerController::update");
    $router->delete("/{worker_id:number}", "Hospital\Worker\WorkerController::delete");
});

$router->get("/doctor", "Hospital\Doctor\DoctorController::getAll");
$router->post("/doctor", "Hospital\Doctor\DoctorController::insert");
$router->group("/doctor", function ($router) {
    $router->get("/{doctor_id:number}", "Hospital\Doctor\DoctorController::get");
    $router->post("/{doctor_id:number}", "Hospital\Doctor\DoctorController::update");
    $router->delete("/{doctor_id:number}", "Hospital\Doctor\DoctorController::delete");
});

$router->get("/staff", "Hospital\Staff\StaffController::getAll");
$router->post("/staff", "Hospital\Staff\StaffController::insert");
$router->group("/staff", function ($router) {
    $router->get("/{staff_id:number}", "Hospital\Staff\StaffController::get");
    $router->post("/{staff_id:number}", "Hospital\Staff\StaffController::update");
    $router->delete("/{staff_id:number}", "Hospital\Staff\StaffController::delete");
});

$router->get("/cafeteria", "Hospital\Cafeteria\CafeteriaController::getAll");
$router->post("/cafeteria", "Hospital\Cafeteria\CafeteriaController::insert");
$router->group("/cafeteria", function ($router) {
    $router->get("/{cafeteria_id:number}", "Hospital\Cafeteria\CafeteriaController::get");
    $router->post("/{cafeteria_id:number}", "Hospital\Cafeteria\CafeteriaController::update");
    $router->delete("/{cafeteria_id:number}", "Hospital\Cafeteria\CafeteriaController::delete");
});

$router->get("/cafeteria-staff", "Hospital\CafeteriaStaff\CafeteriaStaffController::getAll");
$router->post("/cafeteria-staff", "Hospital\CafeteriaStaff\CafeteriaStaffController::insert");
$router->group("/cafeteria-staff", function ($router) {
    $router->get("/{cafetria_staff_id:number}", "Hospital\CafeteriaStaff\CafeteriaStaffController::get");
    $router->post("/{cafetria_staff_id:number}", "Hospital\CafeteriaStaff\CafeteriaStaffController::update");
    $router->delete("/{cafetria_staff_id:number}", "Hospital\CafeteriaStaff\CafeteriaStaffController::delete");
});

$router->get("/bill", "Hospital\Bill\BillController::getAll");
$router->post("/bill", "Hospital\Bill\BillController::insert");
$router->group("/bill", function ($router) {
    $router->get("/{bill_id:number}", "Hospital\Bill\BillController::get");
    $router->post("/{bill_id:number}", "Hospital\Bill\BillController::update");
    $router->delete("/{bill_id:number}", "Hospital\Bill\BillController::delete");
});

$router->get("/patient", "Hospital\Patient\PatientController::getAll");
$router->post("/patient", "Hospital\Patient\PatientController::insert");
$router->group("/patient", function ($router) {
    $router->get("/{patient_id:number}", "Hospital\Patient\PatientController::get");
    $router->post("/{patient_id:number}", "Hospital\Patient\PatientController::update");
    $router->delete("/{patient_id:number}", "Hospital\Patient\PatientController::delete");
});

$router->get("/medication", "Hospital\Medication\MedicationController::getAll");
$router->post("/medication", "Hospital\Medication\MedicationController::insert");
$router->group("/medication", function ($router) {
    $router->get("/{medication_id:number}", "Hospital\Medication\MedicationController::get");
    $router->post("/{medication_id:number}", "Hospital\Medication\MedicationController::update");
    $router->delete("/{medication_id:number}", "Hospital\Medication\MedicationController::delete");
});

$router->get("/medication-prescribed", "Hospital\MedicationPrescribed\MedicationPrescribedController::getAll");
$router->post("/medication-prescribed", "Hospital\MedicationPrescribed\MedicationPrescribedController::insert");
$router->group("/medication-prescribed", function ($router) {
    $router->get("/{medication_prescribed_id:number}", "Hospital\MedicationPrescribed\MedicationPrescribedController::get");
    $router->post("/{medication_prescribed_id:number}", "Hospital\MedicationPrescribed\MedicationPrescribedController::update");
    $router->delete("/{medication_prescribed_id:number}", "Hospital\MedicationPrescribed\MedicationPrescribedController::delete");
});

$router->get("/diagnosis", "Hospital\Diagnosis\DiagnosisController::getAll");
$router->post("/diagnosis", "Hospital\Diagnosis\DiagnosisController::insert");
$router->group("/diagnosis", function ($router) {
    $router->get("/{diagnosis_id:number}", "Hospital\Diagnosis\DiagnosisController::get");
    $router->post("/{diagnosis_id:number}", "Hospital\Diagnosis\DiagnosisController::update");
    $router->delete("/{diagnosis_id:number}", "Hospital\Diagnosis\DiagnosisController::delete");
});

$router->get("/tests", "Hospital\Tests\TestsController::getAll");
$router->post("/tests", "Hospital\Tests\TestsController::insert");
$router->group("/tests", function ($router) {
    $router->get("/{test_id:number}", "Hospital\Tests\TestsController::get");
    $router->post("/{test_id:number}", "Hospital\Tests\TestsController::update");
    $router->delete("/{test_id:number}", "Hospital\Tests\TestsController::delete");
});

$router->get("/doctor-patient", "Hospital\DoctorPatient\DoctorPatientController::getAll");
$router->post("/doctor-patient", "Hospital\DoctorPatient\DoctorPatientController::insert");
$router->group("/doctor-patient", function ($router) {
    $router->get("/{doctor_patient_id:number}", "Hospital\DoctorPatient\DoctorPatientController::get");
    $router->post("/{doctor_patient_id:number}", "Hospital\DoctorPatient\DoctorPatientController::update");
    $router->delete("/{doctor_patient_id:number}", "Hospital\DoctorPatient\DoctorPatientController::delete");
});

