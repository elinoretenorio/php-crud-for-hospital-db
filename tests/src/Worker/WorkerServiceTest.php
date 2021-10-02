<?php

declare(strict_types=1);

namespace Hospital\Tests\Worker;

use PHPUnit\Framework\TestCase;
use Hospital\Worker\{ WorkerDto, WorkerModel, IWorkerService, WorkerService };

class WorkerServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private WorkerDto $dto;
    private WorkerModel $model;
    private IWorkerService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Hospital\Worker\IWorkerRepository");
        $this->input = [
            "worker_id" => 4000,
            "first_name" => "go",
            "last_name" => "or",
            "gender" => "news",
            "telephone" => "station",
            "salary" => 459.60,
        ];
        $this->dto = new WorkerDto($this->input);
        $this->model = new WorkerModel($this->dto);
        $this->service = new WorkerService($this->repository);
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
        $expected = 571;

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
        $expected = 7767;

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
        $workerId = 11;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($workerId)
            ->willReturn(null);

        $actual = $this->service->get($workerId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $workerId = 2825;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($workerId)
            ->willReturn($this->dto);

        $actual = $this->service->get($workerId);
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
        $workerId = 4987;
        $expected = 5464;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($workerId)
            ->willReturn($expected);

        $actual = $this->service->delete($workerId);
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