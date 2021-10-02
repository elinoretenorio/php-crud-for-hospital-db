<?php

declare(strict_types=1);

// Core

$container->add("Pdo", PDO::class)
    ->addArgument("mysql:dbname={$_ENV["DB_NAME"]};host={$_ENV["DB_HOST"]}")
    ->addArgument($_ENV["DB_USER"])
    ->addArgument($_ENV["DB_PASS"])
    ->addArgument([]);
$container->add("Database", Hospital\Database\PdoDatabase::class)
    ->addArgument("Pdo");

// Department

$container->add("DepartmentRepository", Hospital\Department\DepartmentRepository::class)
    ->addArgument("Database");
$container->add("DepartmentService", Hospital\Department\DepartmentService::class)
    ->addArgument("DepartmentRepository");
$container->add(Hospital\Department\DepartmentController::class)
    ->addArgument("DepartmentService");

// Worker

$container->add("WorkerRepository", Hospital\Worker\WorkerRepository::class)
    ->addArgument("Database");
$container->add("WorkerService", Hospital\Worker\WorkerService::class)
    ->addArgument("WorkerRepository");
$container->add(Hospital\Worker\WorkerController::class)
    ->addArgument("WorkerService");

// Doctor

$container->add("DoctorRepository", Hospital\Doctor\DoctorRepository::class)
    ->addArgument("Database");
$container->add("DoctorService", Hospital\Doctor\DoctorService::class)
    ->addArgument("DoctorRepository");
$container->add(Hospital\Doctor\DoctorController::class)
    ->addArgument("DoctorService");

// Staff

$container->add("StaffRepository", Hospital\Staff\StaffRepository::class)
    ->addArgument("Database");
$container->add("StaffService", Hospital\Staff\StaffService::class)
    ->addArgument("StaffRepository");
$container->add(Hospital\Staff\StaffController::class)
    ->addArgument("StaffService");

// Cafeteria

$container->add("CafeteriaRepository", Hospital\Cafeteria\CafeteriaRepository::class)
    ->addArgument("Database");
$container->add("CafeteriaService", Hospital\Cafeteria\CafeteriaService::class)
    ->addArgument("CafeteriaRepository");
$container->add(Hospital\Cafeteria\CafeteriaController::class)
    ->addArgument("CafeteriaService");

// CafeteriaStaff

$container->add("CafeteriaStaffRepository", Hospital\CafeteriaStaff\CafeteriaStaffRepository::class)
    ->addArgument("Database");
$container->add("CafeteriaStaffService", Hospital\CafeteriaStaff\CafeteriaStaffService::class)
    ->addArgument("CafeteriaStaffRepository");
$container->add(Hospital\CafeteriaStaff\CafeteriaStaffController::class)
    ->addArgument("CafeteriaStaffService");

// Bill

$container->add("BillRepository", Hospital\Bill\BillRepository::class)
    ->addArgument("Database");
$container->add("BillService", Hospital\Bill\BillService::class)
    ->addArgument("BillRepository");
$container->add(Hospital\Bill\BillController::class)
    ->addArgument("BillService");

// Patient

$container->add("PatientRepository", Hospital\Patient\PatientRepository::class)
    ->addArgument("Database");
$container->add("PatientService", Hospital\Patient\PatientService::class)
    ->addArgument("PatientRepository");
$container->add(Hospital\Patient\PatientController::class)
    ->addArgument("PatientService");

// Medication

$container->add("MedicationRepository", Hospital\Medication\MedicationRepository::class)
    ->addArgument("Database");
$container->add("MedicationService", Hospital\Medication\MedicationService::class)
    ->addArgument("MedicationRepository");
$container->add(Hospital\Medication\MedicationController::class)
    ->addArgument("MedicationService");

// MedicationPrescribed

$container->add("MedicationPrescribedRepository", Hospital\MedicationPrescribed\MedicationPrescribedRepository::class)
    ->addArgument("Database");
$container->add("MedicationPrescribedService", Hospital\MedicationPrescribed\MedicationPrescribedService::class)
    ->addArgument("MedicationPrescribedRepository");
$container->add(Hospital\MedicationPrescribed\MedicationPrescribedController::class)
    ->addArgument("MedicationPrescribedService");

// Diagnosis

$container->add("DiagnosisRepository", Hospital\Diagnosis\DiagnosisRepository::class)
    ->addArgument("Database");
$container->add("DiagnosisService", Hospital\Diagnosis\DiagnosisService::class)
    ->addArgument("DiagnosisRepository");
$container->add(Hospital\Diagnosis\DiagnosisController::class)
    ->addArgument("DiagnosisService");

// Tests

$container->add("TestsRepository", Hospital\Tests\TestsRepository::class)
    ->addArgument("Database");
$container->add("TestsService", Hospital\Tests\TestsService::class)
    ->addArgument("TestsRepository");
$container->add(Hospital\Tests\TestsController::class)
    ->addArgument("TestsService");

// DoctorPatient

$container->add("DoctorPatientRepository", Hospital\DoctorPatient\DoctorPatientRepository::class)
    ->addArgument("Database");
$container->add("DoctorPatientService", Hospital\DoctorPatient\DoctorPatientService::class)
    ->addArgument("DoctorPatientRepository");
$container->add(Hospital\DoctorPatient\DoctorPatientController::class)
    ->addArgument("DoctorPatientService");

