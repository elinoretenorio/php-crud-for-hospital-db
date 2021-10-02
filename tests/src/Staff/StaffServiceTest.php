<?php

declare(strict_types=1);

namespace Hospital\Tests\Staff;

use PHPUnit\Framework\TestCase;
use Hospital\Staff\{ StaffDto, StaffModel, IStaffService, StaffService };

class StaffServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private StaffDto $dto;
    private StaffModel $model;
    private IStaffService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Hospital\Staff\IStaffRepository");
        $this->input = [
            "staff_id" => 1696,
            "job_title" => "million",
            "worker_id" => 4640,
        ];
        $this->dto = new StaffDto($this->input);
        $this->model = new StaffModel($this->dto);
        $this->service = new StaffService($this->repository);
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
        $expected = 5111;

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
        $expected = 2056;

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
        $staffId = 5462;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($staffId)
            ->willReturn(null);

        $actual = $this->service->get($staffId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $staffId = 8540;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($staffId)
            ->willReturn($this->dto);

        $actual = $this->service->get($staffId);
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
        $staffId = 1325;
        $expected = 989;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($staffId)
            ->willReturn($expected);

        $actual = $this->service->delete($staffId);
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