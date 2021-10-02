<?php

declare(strict_types=1);

namespace Hospital\Tests\MedicationPrescribed;

use PHPUnit\Framework\TestCase;
use Hospital\MedicationPrescribed\{ MedicationPrescribedDto, MedicationPrescribedModel };

class MedicationPrescribedModelTest extends TestCase
{
    private array $input;
    private MedicationPrescribedDto $dto;
    private MedicationPrescribedModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "medication_prescribed_id" => 1564,
            "prescription_id" => 3512,
            "medication_id" => "recently",
            "patient_id" => 6004,
        ];
        $this->dto = new MedicationPrescribedDto($this->input);
        $this->model = new MedicationPrescribedModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new MedicationPrescribedModel(null);

        $this->assertInstanceOf(MedicationPrescribedModel::class, $model);
    }

    public function testGetMedicationPrescribedId(): void
    {
        $this->assertEquals($this->dto->medicationPrescribedId, $this->model->getMedicationPrescribedId());
    }

    public function testSetMedicationPrescribedId(): void
    {
        $expected = 5021;
        $model = $this->model;
        $model->setMedicationPrescribedId($expected);

        $this->assertEquals($expected, $model->getMedicationPrescribedId());
    }

    public function testGetPrescriptionId(): void
    {
        $this->assertEquals($this->dto->prescriptionId, $this->model->getPrescriptionId());
    }

    public function testSetPrescriptionId(): void
    {
        $expected = 4143;
        $model = $this->model;
        $model->setPrescriptionId($expected);

        $this->assertEquals($expected, $model->getPrescriptionId());
    }

    public function testGetMedicationId(): void
    {
        $this->assertEquals($this->dto->medicationId, $this->model->getMedicationId());
    }

    public function testSetMedicationId(): void
    {
        $expected = "until";
        $model = $this->model;
        $model->setMedicationId($expected);

        $this->assertEquals($expected, $model->getMedicationId());
    }

    public function testGetPatientId(): void
    {
        $this->assertEquals($this->dto->patientId, $this->model->getPatientId());
    }

    public function testSetPatientId(): void
    {
        $expected = 7757;
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