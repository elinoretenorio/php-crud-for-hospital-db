<?php

declare(strict_types=1);

namespace Hospital\Tests\Patient;

use PHPUnit\Framework\TestCase;
use Hospital\Patient\{ PatientDto, PatientModel, IPatientService, PatientService };

class PatientServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private PatientDto $dto;
    private PatientModel $model;
    private IPatientService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Hospital\Patient\IPatientRepository");
        $this->input = [
            "patient_id" => 2093,
            "first_name" => "garden",
            "last_name" => "study",
            "address" => "Nor whole similar population. Management yes we message green general.",
            "telephone" => "possible",
            "gender" => "explain",
            "age" => 3157,
            "blood_type" => "structure",
            "cafeteria_id" => "book",
            "bill_id" => 2923,
        ];
        $this->dto = new PatientDto($this->input);
        $this->model = new PatientModel($this->dto);
        $this->service = new PatientService($this->repository);
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
        $expected = 986;

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
        $expected = 4185;

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
        $patientId = 6912;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($patientId)
            ->willReturn(null);

        $actual = $this->service->get($patientId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $patientId = 1758;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($patientId)
            ->willReturn($this->dto);

        $actual = $this->service->get($patientId);
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
        $patientId = 6271;
        $expected = 4908;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($patientId)
            ->willReturn($expected);

        $actual = $this->service->delete($patientId);
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