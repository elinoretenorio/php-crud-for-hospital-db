<?php

declare(strict_types=1);

namespace Hospital\Tests\DoctorPatient;

use PHPUnit\Framework\TestCase;
use Hospital\DoctorPatient\{ DoctorPatientDto, DoctorPatientModel, IDoctorPatientService, DoctorPatientService };

class DoctorPatientServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private DoctorPatientDto $dto;
    private DoctorPatientModel $model;
    private IDoctorPatientService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Hospital\DoctorPatient\IDoctorPatientRepository");
        $this->input = [
            "doctor_patient_id" => 3760,
            "doctor_id" => 1567,
            "patient_id" => 8674,
            "examination_date" => "2021-10-12",
        ];
        $this->dto = new DoctorPatientDto($this->input);
        $this->model = new DoctorPatientModel($this->dto);
        $this->service = new DoctorPatientService($this->repository);
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
        $expected = 1666;

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
        $expected = 4924;

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
        $doctorPatientId = 2559;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($doctorPatientId)
            ->willReturn(null);

        $actual = $this->service->get($doctorPatientId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $doctorPatientId = 7335;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($doctorPatientId)
            ->willReturn($this->dto);

        $actual = $this->service->get($doctorPatientId);
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
        $doctorPatientId = 3840;
        $expected = 6976;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($doctorPatientId)
            ->willReturn($expected);

        $actual = $this->service->delete($doctorPatientId);
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