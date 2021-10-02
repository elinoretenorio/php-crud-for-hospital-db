<?php

declare(strict_types=1);

namespace Hospital\Tests\CafeteriaStaff;

use PHPUnit\Framework\TestCase;
use Hospital\CafeteriaStaff\{ CafeteriaStaffDto, CafeteriaStaffModel };

class CafeteriaStaffModelTest extends TestCase
{
    private array $input;
    private CafeteriaStaffDto $dto;
    private CafeteriaStaffModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "cafetria_staff_id" => 5848,
            "staff_id" => 4348,
            "cafeteria_id" => "hard",
            "position" => "through",
        ];
        $this->dto = new CafeteriaStaffDto($this->input);
        $this->model = new CafeteriaStaffModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new CafeteriaStaffModel(null);

        $this->assertInstanceOf(CafeteriaStaffModel::class, $model);
    }

    public function testGetCafetriaStaffId(): void
    {
        $this->assertEquals($this->dto->cafetriaStaffId, $this->model->getCafetriaStaffId());
    }

    public function testSetCafetriaStaffId(): void
    {
        $expected = 7168;
        $model = $this->model;
        $model->setCafetriaStaffId($expected);

        $this->assertEquals($expected, $model->getCafetriaStaffId());
    }

    public function testGetStaffId(): void
    {
        $this->assertEquals($this->dto->staffId, $this->model->getStaffId());
    }

    public function testSetStaffId(): void
    {
        $expected = 5165;
        $model = $this->model;
        $model->setStaffId($expected);

        $this->assertEquals($expected, $model->getStaffId());
    }

    public function testGetCafeteriaId(): void
    {
        $this->assertEquals($this->dto->cafeteriaId, $this->model->getCafeteriaId());
    }

    public function testSetCafeteriaId(): void
    {
        $expected = "report";
        $model = $this->model;
        $model->setCafeteriaId($expected);

        $this->assertEquals($expected, $model->getCafeteriaId());
    }

    public function testGetPosition(): void
    {
        $this->assertEquals($this->dto->position, $this->model->getPosition());
    }

    public function testSetPosition(): void
    {
        $expected = "society";
        $model = $this->model;
        $model->setPosition($expected);

        $this->assertEquals($expected, $model->getPosition());
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