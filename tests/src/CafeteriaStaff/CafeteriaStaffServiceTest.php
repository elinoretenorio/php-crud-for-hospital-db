<?php

declare(strict_types=1);

namespace Hospital\Tests\CafeteriaStaff;

use PHPUnit\Framework\TestCase;
use Hospital\CafeteriaStaff\{ CafeteriaStaffDto, CafeteriaStaffModel, ICafeteriaStaffService, CafeteriaStaffService };

class CafeteriaStaffServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private CafeteriaStaffDto $dto;
    private CafeteriaStaffModel $model;
    private ICafeteriaStaffService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Hospital\CafeteriaStaff\ICafeteriaStaffRepository");
        $this->input = [
            "cafetria_staff_id" => 6948,
            "staff_id" => 5542,
            "cafeteria_id" => "win",
            "position" => "act",
        ];
        $this->dto = new CafeteriaStaffDto($this->input);
        $this->model = new CafeteriaStaffModel($this->dto);
        $this->service = new CafeteriaStaffService($this->repository);
    }

    protected function tearDown(): void
    {
        unset($this->repository);
        unset($this->input);
        unset($this->dto);
        unset($this->model);
        unset($this->service);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 3708;

        $this->repository->expects($this->once())
            ->method("insert")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->insert($this->model);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsEmpty(): void
    {
        $expected = 0;

        $this->repository->expects($this->once())
            ->method("insert")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->insert($this->model);
        $this->assertEmpty($actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 9842;

        $this->repository->expects($this->once())
            ->method("update")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->update($this->model);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsEmpty(): void
    {
        $expected = 0;

        $this->repository->expects($this->once())
            ->method("update")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->update($this->model);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsNull(): void
    {
        $cafetriaStaffId = 5629;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($cafetriaStaffId)
            ->willReturn(null);

        $actual = $this->service->get($cafetriaStaffId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $cafetriaStaffId = 1433;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($cafetriaStaffId)
            ->willReturn($this->dto);

        $actual = $this->service->get($cafetriaStaffId);
        $this->assertEquals($this->model, $actual);
    }

    public function testGetAll_ReturnsEmpty(): void
    {
        $this->repository->expects($this->once())
            ->method("getAll")
            ->willReturn([]);

        $actual = $this->service->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsModels(): void
    {
        $this->repository->expects($this->once())
            ->method("getAll")
            ->willReturn([$this->dto]);

        $actual = $this->service->getAll();
        $this->assertEquals([$this->model], $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $cafetriaStaffId = 5090;
        $expected = 6482;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($cafetriaStaffId)
            ->willReturn($expected);

        $actual = $this->service->delete($cafetriaStaffId);
        $this->assertEquals($expected, $actual);
    }

    public function testCreateModel_ReturnsNullIfEmpty(): void
    {
        $actual = $this->service->createModel([]);
        $this->assertNull($actual);
    }

    public function testCreateModel_ReturnsModel(): void
    {
        $actual = $this->service->createModel($this->input);
        $this->assertEquals($this->model, $actual);
    }
}