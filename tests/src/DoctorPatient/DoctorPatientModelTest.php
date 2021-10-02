<?php

declare(strict_types=1);

namespace Hospital\Tests\DoctorPatient;

use PHPUnit\Framework\TestCase;
use Hospital\DoctorPatient\{ DoctorPatientDto, DoctorPatientModel };

class DoctorPatientModelTest extends TestCase
{
    private array $input;
    private DoctorPatientDto $dto;
    private DoctorPatientModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "doctor_patient_id" => 8854,
            "doctor_id" => 9091,
            "patient_id" => 5698,
            "examination_date" => "2021-10-13",
        ];
        $this->dto = new DoctorPatientDto($this->input);
        $this->model = new DoctorPatientModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new DoctorPatientModel(null);

        $this->assertInstanceOf(DoctorPatientModel::class, $model);
    }

    public function testGetDoctorPatientId(): void
    {
        $this->assertEquals($this->dto->doctorPatientId, $this->model->getDoctorPatientId());
    }

    public function testSetDoctorPatientId(): void
    {
        $expected = 7359;
        $model = $this->model;
        $model->setDoctorPatientId($expected);

        $this->assertEquals($expected, $model->getDoctorPatientId());
    }

    public function testGetDoctorId(): void
    {
        $this->assertEquals($this->dto->doctorId, $this->model->getDoctorId());
    }

    public function testSetDoctorId(): void
    {
        $expected = 3027;
        $model = $this->model;
        $model->setDoctorId($expected);

        $this->assertEquals($expected, $model->getDoctorId());
    }

    public function testGetPatientId(): void
    {
        $this->assertEquals($this->dto->patientId, $this->model->getPatientId());
    }

    public function testSetPatientId(): void
    {
        $expected = 3496;
        $model = $this->model;
        $model->setPatientId($expected);

        $this->assertEquals($expected, $model->getPatientId());
    }

    public function testGetExaminationDate(): void
    {
        $this->assertEquals($this->dto->examinationDate, $this->model->getExaminationDate());
    }

    public function testSetExaminationDate(): void
    {
        $expected = "2021-09-20";
        $model = $this->model;
        $model->setExaminationDate($expected);

        $this->assertEquals($expected, $model->getExaminationDate());
    }

    public function testToDto(): void
    {
        $this->assertEquals($this->dto, $this->model->toDto());
    }

    public function testJsonSerialize(): void
    {
        $this->assertEquals($this->input, $this->model->jsonSerialize());
    }
}