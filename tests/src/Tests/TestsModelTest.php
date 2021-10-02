<?php

declare(strict_types=1);

namespace Hospital\Tests\Tests;

use PHPUnit\Framework\TestCase;
use Hospital\Tests\{ TestsDto, TestsModel };

class TestsModelTest extends TestCase
{
    private array $input;
    private TestsDto $dto;
    private TestsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "test_id" => 7085,
            "result" => 8632,
            "illness" => "baby",
            "doctor_id" => 3986,
            "patient_id" => 9818,
        ];
        $this->dto = new TestsDto($this->input);
        $this->model = new TestsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new TestsModel(null);

        $this->assertInstanceOf(TestsModel::class, $model);
    }

    public function testGetTestId(): void
    {
        $this->assertEquals($this->dto->testId, $this->model->getTestId());
    }

    public function testSetTestId(): void
    {
        $expected = 9144;
        $model = $this->model;
        $model->setTestId($expected);

        $this->assertEquals($expected, $model->getTestId());
    }

    public function testGetResult(): void
    {
        $this->assertEquals($this->dto->result, $this->model->getResult());
    }

    public function testSetResult(): void
    {
        $expected = 5931;
        $model = $this->model;
        $model->setResult($expected);

        $this->assertEquals($expected, $model->getResult());
    }

    public function testGetIllness(): void
    {
        $this->assertEquals($this->dto->illness, $this->model->getIllness());
    }

    public function testSetIllness(): void
    {
        $expected = "thought";
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
        $expected = 6670;
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
        $expected = 5731;
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