<?php

declare(strict_types=1);

namespace Hospital\Tests\Doctor;

use PHPUnit\Framework\TestCase;
use Hospital\Doctor\{ DoctorDto, DoctorModel, IDoctorService, DoctorService };

class DoctorServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private DoctorDto $dto;
    private DoctorModel $model;
    private IDoctorService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Hospital\Doctor\IDoctorRepository");
        $this->input = [
            "doctor_id" => 9034,
            "field" => "town",
            "degree" => "itself",
            "department_id" => "impact",
            "worker_id" => 2900,
        ];
        $this->dto = new DoctorDto($this->input);
        $this->model = new DoctorModel($this->dto);
        $this->service = new DoctorService($this->repository);
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
        $expected = 3331;

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
        $expected = 1621;

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
        $doctorId = 6341;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($doctorId)
            ->willReturn(null);

        $actual = $this->service->get($doctorId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $doctorId = 8055;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($doctorId)
            ->willReturn($this->dto);

        $actual = $this->service->get($doctorId);
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
        $doctorId = 9892;
        $expected = 7156;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($doctorId)
            ->willReturn($expected);

        $actual = $this->service->delete($doctorId);
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