<?php

declare(strict_types=1);

namespace Hospital\Tests\Tests;

use PHPUnit\Framework\TestCase;
use Hospital\Tests\{ TestsDto, TestsModel, ITestsService, TestsService };

class TestsServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private TestsDto $dto;
    private TestsModel $model;
    private ITestsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Hospital\Tests\ITestsRepository");
        $this->input = [
            "test_id" => 297,
            "result" => 2352,
            "illness" => "might",
            "doctor_id" => 5015,
            "patient_id" => 4228,
        ];
        $this->dto = new TestsDto($this->input);
        $this->model = new TestsModel($this->dto);
        $this->service = new TestsService($this->repository);
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
        $expected = 2371;

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
        $expected = 8379;

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
        $testId = 7049;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($testId)
            ->willReturn(null);

        $actual = $this->service->get($testId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $testId = 523;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($testId)
            ->willReturn($this->dto);

        $actual = $this->service->get($testId);
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
        $testId = 1788;
        $expected = 5147;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($testId)
            ->willReturn($expected);

        $actual = $this->service->delete($testId);
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