<?php

declare(strict_types=1);

namespace Hospital\Tests\Patient;

use PHPUnit\Framework\TestCase;
use Hospital\Patient\{ PatientDto, PatientModel };

class PatientModelTest extends TestCase
{
    private array $input;
    private PatientDto $dto;
    private PatientModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "patient_id" => 9032,
            "first_name" => "prove",
            "last_name" => "alone",
            "address" => "Nature if half simple reality shake. Cultural well purpose body and. Remain word either five for.",
            "telephone" => "write",
            "gender" => "example",
            "age" => 8412,
            "blood_type" => "change",
            "cafeteria_id" => "reality",
            "bill_id" => 9027,
        ];
        $this->dto = new PatientDto($this->input);
        $this->model = new PatientModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new PatientModel(null);

        $this->assertInstanceOf(PatientModel::class, $model);
    }

    public function testGetPatientId(): void
    {
        $this->assertEquals($this->dto->patientId, $this->model->getPatientId());
    }

    public function testSetPatientId(): void
    {
        $expected = 3699;
        $model = $this->model;
        $model->setPatientId($expected);

        $this->assertEquals($expected, $model->getPatientId());
    }

    public function testGetFirstName(): void
    {
        $this->assertEquals($this->dto->firstName, $this->model->getFirstName());
    }

    public function testSetFirstName(): void
    {
        $expected = "whose";
        $model = $this->model;
        $model->setFirstName($expected);

        $this->assertEquals($expected, $model->getFirstName());
    }

    public function testGetLastName(): void
    {
        $this->assertEquals($this->dto->lastName, $this->model->getLastName());
    }

    public function testSetLastName(): void
    {
        $expected = "look";
        $model = $this->model;
        $model->setLastName($expected);

        $this->assertEquals($expected, $model->getLastName());
    }

    public function testGetAddress(): void
    {
        $this->assertEquals($this->dto->address, $this->model->getAddress());
    }

    public function testSetAddress(): void
    {
        $expected = "Whole see trouble until other but. Quite fast mean man.";
        $model = $this->model;
        $model->setAddress($expected);

        $this->assertEquals($expected, $model->getAddress());
    }

    public function testGetTelephone(): void
    {
        $this->assertEquals($this->dto->telephone, $this->model->getTelephone());
    }

    public function testSetTelephone(): void
    {
        $expected = "current";
        $model = $this->model;
        $model->setTelephone($expected);

        $this->assertEquals($expected, $model->getTelephone());
    }

    public function testGetGender(): void
    {
        $this->assertEquals($this->dto->gender, $this->model->getGender());
    }

    public function testSetGender(): void
    {
        $expected = "reason";
        $model = $this->model;
        $model->setGender($expected);

        $this->assertEquals($expected, $model->getGender());
    }

    public function testGetAge(): void
    {
        $this->assertEquals($this->dto->age, $this->model->getAge());
    }

    public function testSetAge(): void
    {
        $expected = 3233;
        $model = $this->model;
        $model->setAge($expected);

        $this->assertEquals($expected, $model->getAge());
    }

    public function testGetBloodType(): void
    {
        $this->assertEquals($this->dto->bloodType, $this->model->getBloodType());
    }

    public function testSetBloodType(): void
    {
        $expected = "design";
        $model = $this->model;
        $model->setBloodType($expected);

        $this->assertEquals($expected, $model->getBloodType());
    }

    public function testGetCafeteriaId(): void
    {
        $this->assertEquals($this->dto->cafeteriaId, $this->model->getCafeteriaId());
    }

    public function testSetCafeteriaId(): void
    {
        $expected = "place";
        $model = $this->model;
        $model->setCafeteriaId($expected);

        $this->assertEquals($expected, $model->getCafeteriaId());
    }

    public function testGetBillId(): void
    {
        $this->assertEquals($this->dto->billId, $this->model->getBillId());
    }

    public function testSetBillId(): void
    {
        $expected = 4875;
        $model = $this->model;
        $model->setBillId($expected);

        $this->assertEquals($expected, $model->getBillId());
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