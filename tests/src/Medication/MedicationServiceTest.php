<?php

declare(strict_types=1);

namespace Hospital\Tests\Medication;

use PHPUnit\Framework\TestCase;
use Hospital\Medication\{ MedicationDto, MedicationModel, IMedicationService, MedicationService };

class MedicationServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private MedicationDto $dto;
    private MedicationModel $model;
    private IMedicationService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Hospital\Medication\IMedicationRepository");
        $this->input = [
            "medication_id" => 3785,
            "doses" => 3132,
            "expiration_date" => "2021-10-08",
        ];
        $this->dto = new MedicationDto($this->input);
        $this->model = new MedicationModel($this->dto);
        $this->service = new MedicationService($this->repository);
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
        $expected = 7951;

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
        $expected = 2414;

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
        $medicationId = 7652;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($medicationId)
            ->willReturn(null);

        $actual = $this->service->get($medicationId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $medicationId = 4894;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($medicationId)
            ->willReturn($this->dto);

        $actual = $this->service->get($medicationId);
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
        $medicationId = 3650;
        $expected = 9789;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($medicationId)
            ->willReturn($expected);

        $actual = $this->service->delete($medicationId);
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