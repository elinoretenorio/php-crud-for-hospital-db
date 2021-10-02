<?php

declare(strict_types=1);

namespace Hospital\Tests\Department;

use PHPUnit\Framework\TestCase;
use Hospital\Department\{ DepartmentDto, DepartmentModel };

class DepartmentModelTest extends TestCase
{
    private array $input;
    private DepartmentDto $dto;
    private DepartmentModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "department_id" => 8738,
            "workers" => 264,
            "building_location" => "loss",
        ];
        $this->dto = new DepartmentDto($this->input);
        $this->model = new DepartmentModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new DepartmentModel(null);

        $this->assertInstanceOf(DepartmentModel::class, $model);
    }

    public function testGetDepartmentId(): void
    {
        $this->assertEquals($this->dto->departmentId, $this->model->getDepartmentId());
    }

    public function testSetDepartmentId(): void
    {
        $expected = 9159;
        $model = $this->model;
        $model->setDepartmentId($expected);

        $this->assertEquals($expected, $model->getDepartmentId());
    }

    public function testGetWorkers(): void
    {
        $this->assertEquals($this->dto->workers, $this->model->getWorkers());
    }

    public function testSetWorkers(): void
    {
        $expected = 5394;
        $model = $this->model;
        $model->setWorkers($expected);

        $this->assertEquals($expected, $model->getWorkers());
    }

    public function testGetBuildingLocation(): void
    {
        $this->assertEquals($this->dto->buildingLocation, $this->model->getBuildingLocation());
    }

    public function testSetBuildingLocation(): void
    {
        $expected = "speech";
        $model = $this->model;
        $model->setBuildingLocation($expected);

        $this->assertEquals($expected, $model->getBuildingLocation());
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