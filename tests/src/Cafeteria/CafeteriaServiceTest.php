<?php

declare(strict_types=1);

namespace Hospital\Tests\Cafeteria;

use PHPUnit\Framework\TestCase;
use Hospital\Cafeteria\{ CafeteriaDto, CafeteriaModel, ICafeteriaService, CafeteriaService };

class CafeteriaServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private CafeteriaDto $dto;
    private CafeteriaModel $model;
    private ICafeteriaService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Hospital\Cafeteria\ICafeteriaRepository");
        $this->input = [
            "cafeteria_id" => 6311,
            "food_type" => "military",
            "seating" => 8535,
        ];
        $this->dto = new CafeteriaDto($this->input);
        $this->model = new CafeteriaModel($this->dto);
        $this->service = new CafeteriaService($this->repository);
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
        $expected = 4825;

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
        $expected = 6505;

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
        $cafeteriaId = 4968;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($cafeteriaId)
            ->willReturn(null);

        $actual = $this->service->get($cafeteriaId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $cafeteriaId = 3251;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($cafeteriaId)
            ->willReturn($this->dto);

        $actual = $this->service->get($cafeteriaId);
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
        $cafeteriaId = 7279;
        $expected = 4518;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($cafeteriaId)
            ->willReturn($expected);

        $actual = $this->service->delete($cafeteriaId);
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