<?php

declare(strict_types=1);

namespace Hospital\Tests\Bill;

use PHPUnit\Framework\TestCase;
use Hospital\Bill\{ BillDto, BillModel, IBillService, BillService };

class BillServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private BillDto $dto;
    private BillModel $model;
    private IBillService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Hospital\Bill\IBillRepository");
        $this->input = [
            "bill_id" => 7590,
            "tests" => "Congress",
            "treatment" => "yourself",
            "time_admitted" => "2021-10-03",
            "prescription" => "western",
        ];
        $this->dto = new BillDto($this->input);
        $this->model = new BillModel($this->dto);
        $this->service = new BillService($this->repository);
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
        $expected = 410;

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
        $expected = 363;

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
        $billId = 6589;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($billId)
            ->willReturn(null);

        $actual = $this->service->get($billId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $billId = 8738;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($billId)
            ->willReturn($this->dto);

        $actual = $this->service->get($billId);
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
        $billId = 6561;
        $expected = 5293;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($billId)
            ->willReturn($expected);

        $actual = $this->service->delete($billId);
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