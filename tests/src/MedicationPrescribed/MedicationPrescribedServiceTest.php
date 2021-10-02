<?php

declare(strict_types=1);

namespace Hospital\Tests\MedicationPrescribed;

use PHPUnit\Framework\TestCase;
use Hospital\MedicationPrescribed\{ MedicationPrescribedDto, MedicationPrescribedModel, IMedicationPrescribedService, MedicationPrescribedService };

class MedicationPrescribedServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private MedicationPrescribedDto $dto;
    private MedicationPrescribedModel $model;
    private IMedicationPrescribedService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Hospital\MedicationPrescribed\IMedicationPrescribedRepository");
        $this->input = [
            "medication_prescribed_id" => 5685,
            "prescription_id" => 367,
            "medication_id" => "catch",
            "patient_id" => 6054,
        ];
        $this->dto = new MedicationPrescribedDto($this->input);
        $this->model = new MedicationPrescribedModel($this->dto);
        $this->service = new MedicationPrescribedService($this->repository);
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
        $expected = 1449;

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
        $expected = 5189;

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
        $medicationPrescribedId = 1305;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($medicationPrescribedId)
            ->willReturn(null);

        $actual = $this->service->get($medicationPrescribedId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $medicationPrescribedId = 2118;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($medicationPrescribedId)
            ->willReturn($this->dto);

        $actual = $this->service->get($medicationPrescribedId);
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
        $medicationPrescribedId = 8602;
        $expected = 7568;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($medicationPrescribedId)
            ->willReturn($expected);

        $actual = $this->service->delete($medicationPrescribedId);
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