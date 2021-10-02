<?php

declare(strict_types=1);

namespace Hospital\Tests\Worker;

use PHPUnit\Framework\TestCase;
use Hospital\Worker\{ WorkerDto, WorkerModel };

class WorkerModelTest extends TestCase
{
    private array $input;
    private WorkerDto $dto;
    private WorkerModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "worker_id" => 4036,
            "first_name" => "animal",
            "last_name" => "with",
            "gender" => "base",
            "telephone" => "radio",
            "salary" => 243.17,
        ];
        $this->dto = new WorkerDto($this->input);
        $this->model = new WorkerModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new WorkerModel(null);

        $this->assertInstanceOf(WorkerModel::class, $model);
    }

    public function testGetWorkerId(): void
    {
        $this->assertEquals($this->dto->workerId, $this->model->getWorkerId());
    }

    public function testSetWorkerId(): void
    {
        $expected = 9214;
        $model = $this->model;
        $model->setWorkerId($expected);

        $this->assertEquals($expected, $model->getWorkerId());
    }

    public function testGetFirstName(): void
    {
        $this->assertEquals($this->dto->firstName, $this->model->getFirstName());
    }

    public function testSetFirstName(): void
    {
        $expected = "factor";
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
        $expected = "national";
        $model = $this->model;
        $model->setLastName($expected);

        $this->assertEquals($expected, $model->getLastName());
    }

    public function testGetGender(): void
    {
        $this->assertEquals($this->dto->gender, $this->model->getGender());
    }

    public function testSetGender(): void
    {
        $expected = "have";
        $model = $this->model;
        $model->setGender($expected);

        $this->assertEquals($expected, $model->getGender());
    }

    public function testGetTelephone(): void
    {
        $this->assertEquals($this->dto->telephone, $this->model->getTelephone());
    }

    public function testSetTelephone(): void
    {
        $expected = "including";
        $model = $this->model;
        $model->setTelephone($expected);

        $this->assertEquals($expected, $model->getTelephone());
    }

    public function testGetSalary(): void
    {
        $this->assertEquals($this->dto->salary, $this->model->getSalary());
    }

    public function testSetSalary(): void
    {
        $expected = 408.34;
        $model = $this->model;
        $model->setSalary($expected);

        $this->assertEquals($expected, $model->getSalary());
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