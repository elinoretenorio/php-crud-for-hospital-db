<?php

declare(strict_types=1);

namespace Hospital\Tests\Diagnosis;

use PHPUnit\Framework\TestCase;
use Hospital\Diagnosis\{ DiagnosisDto, DiagnosisModel, IDiagnosisService, DiagnosisService };

class DiagnosisServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private DiagnosisDto $dto;
    private DiagnosisModel $model;
    private IDiagnosisService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Hospital\Diagnosis\IDiagnosisRepository");
        $this->input = [
            "diagnosis_id" => 1516,
            "illness" => "radio",
            "doctor_id" => 4987,
            "patient_id" => 4566,
        ];
        $this->dto = new DiagnosisDto($this->input);
        $this->model = new DiagnosisModel($this->dto);
        $this->service = new DiagnosisService($this->repository);
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
        $expected = 5171;

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
        $expected = 6164;

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
        $diagnosisId = 9753;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($diagnosisId)
            ->willReturn(null);

        $actual = $this->service->get($diagnosisId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $diagnosisId = 4668;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($diagnosisId)
            ->willReturn($this->dto);

        $actual = $this->service->get($diagnosisId);
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
        $diagnosisId = 4684;
        $expected = 837;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($diagnosisId)
            ->willReturn($expected);

        $actual = $this->service->delete($diagnosisId);
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