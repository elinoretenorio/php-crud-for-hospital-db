<?php

declare(strict_types=1);

namespace Hospital\Tests\Doctor;

use PHPUnit\Framework\TestCase;
use Hospital\Doctor\{ DoctorDto, DoctorModel };

class DoctorModelTest extends TestCase
{
    private array $input;
    private DoctorDto $dto;
    private DoctorModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "doctor_id" => 2003,
            "field" => "true",
            "degree" => "recently",
            "department_id" => "ground",
            "worker_id" => 2264,
        ];
        $this->dto = new DoctorDto($this->input);
        $this->model = new DoctorModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new DoctorModel(null);

        $this->assertInstanceOf(DoctorModel::class, $model);
    }

    public function testGetDoctorId(): void
    {
        $this->assertEquals($this->dto->doctorId, $this->model->getDoctorId());
    }

    public function testSetDoctorId(): void
    {
        $expected = 2177;
        $model = $this->model;
        $model->setDoctorId($expected);

        $this->assertEquals($expected, $model->getDoctorId());
    }

    public function testGetField(): void
    {
        $this->assertEquals($this->dto->field, $this->model->getField());
    }

    public function testSetField(): void
    {
        $expected = "population";
        $model = $this->model;
        $model->setField($expected);

        $this->assertEquals($expected, $model->getField());
    }

    public function testGetDegree(): void
    {
        $this->assertEquals($this->dto->degree, $this->model->getDegree());
    }

    public function testSetDegree(): void
    {
        $expected = "art";
        $model = $this->model;
        $model->setDegree($expected);

        $this->assertEquals($expected, $model->getDegree());
    }

    public function testGetDepartmentId(): void
    {
        $this->assertEquals($this->dto->departmentId, $this->model->getDepartmentId());
    }

    public function testSetDepartmentId(): void
    {
        $expected = "listen";
        $model = $this->model;
        $model->setDepartmentId($expected);

        $this->assertEquals($expected, $model->getDepartmentId());
    }

    public function testGetWorkerId(): void
    {
        $this->assertEquals($this->dto->workerId, $this->model->getWorkerId());
    }

    public function testSetWorkerId(): void
    {
        $expected = 4592;
        $model = $this->model;
        $model->setWorkerId($expected);

        $this->assertEquals($expected, $model->getWorkerId());
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