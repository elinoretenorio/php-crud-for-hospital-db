<?php

declare(strict_types=1);

namespace Hospital\Tests\Staff;

use PHPUnit\Framework\TestCase;
use Hospital\Staff\{ StaffDto, StaffModel };

class StaffModelTest extends TestCase
{
    private array $input;
    private StaffDto $dto;
    private StaffModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "staff_id" => 1620,
            "job_title" => "stay",
            "worker_id" => 4660,
        ];
        $this->dto = new StaffDto($this->input);
        $this->model = new StaffModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new StaffModel(null);

        $this->assertInstanceOf(StaffModel::class, $model);
    }

    public function testGetStaffId(): void
    {
        $this->assertEquals($this->dto->staffId, $this->model->getStaffId());
    }

    public function testSetStaffId(): void
    {
        $expected = 8342;
        $model = $this->model;
        $model->setStaffId($expected);

        $this->assertEquals($expected, $model->getStaffId());
    }

    public function testGetJobTitle(): void
    {
        $this->assertEquals($this->dto->jobTitle, $this->model->getJobTitle());
    }

    public function testSetJobTitle(): void
    {
        $expected = "cultural";
        $model = $this->model;
        $model->setJobTitle($expected);

        $this->assertEquals($expected, $model->getJobTitle());
    }

    public function testGetWorkerId(): void
    {
        $this->assertEquals($this->dto->workerId, $this->model->getWorkerId());
    }

    public function testSetWorkerId(): void
    {
        $expected = 4699;
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