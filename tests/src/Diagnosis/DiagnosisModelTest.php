<?php

declare(strict_types=1);

namespace Hospital\Tests\Diagnosis;

use PHPUnit\Framework\TestCase;
use Hospital\Diagnosis\{ DiagnosisDto, DiagnosisModel };

class DiagnosisModelTest extends TestCase
{
    private array $input;
    private DiagnosisDto $dto;
    private DiagnosisModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "diagnosis_id" => 1160,
            "illness" => "every",
            "doctor_id" => 8808,
            "patient_id" => 8552,
        ];
        $this->dto = new DiagnosisDto($this->input);
        $this->model = new DiagnosisModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new DiagnosisModel(null);

        $this->assertInstanceOf(DiagnosisModel::class, $model);
    }

    public function testGetDiagnosisId(): void
    {
        $this->assertEquals($this->dto->diagnosisId, $this->model->getDiagnosisId());
    }

    public function testSetDiagnosisId(): void
    {
        $expected = 6433;
        $model = $this->model;
        $model->setDiagnosisId($expected);

        $this->assertEquals($expected, $model->getDiagnosisId());
    }

    public function testGetIllness(): void
    {
        $this->assertEquals($this->dto->illness, $this->model->getIllness());
    }

    public function testSetIllness(): void
    {
        $expected = "indeed";
        $model = $this->model;
        $model->setIllness($expected);

        $this->assertEquals($expected, $model->getIllness());
    }

    public function testGetDoctorId(): void
    {
        $this->assertEquals($this->dto->doctorId, $this->model->getDoctorId());
    }

    public function testSetDoctorId(): void
    {
        $expected = 151;
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
        $expected = 1637;
        $model = $this->model;
        $model->setPatientId($expected);

        $this->assertEquals($expected, $model->getPatientId());
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