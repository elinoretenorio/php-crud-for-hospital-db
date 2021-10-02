<?php

declare(strict_types=1);

namespace Hospital\Tests\Cafeteria;

use PHPUnit\Framework\TestCase;
use Hospital\Database\DatabaseException;
use Hospital\Cafeteria\{ CafeteriaDto, ICafeteriaRepository, CafeteriaRepository };

class CafeteriaRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private CafeteriaDto $dto;
    private ICafeteriaRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Hospital\Database\IDatabase");
        $this->result = $this->createMock("Hospital\Database\IDatabaseResult");
        $this->input = [
            "cafeteria_id" => 2900,
            "food_type" => "trial",
            "seating" => 2904,
        ];
        $this->dto = new CafeteriaDto($this->input);
        $this->repository = new CafeteriaRepository($this->db);
    }

    protected function tearDown(): void
    {
        unset($this->db);
        unset($this->result);
        unset($this->input);
        unset($this->dto);
        unset($this->repository);
    }

    public function testInsert_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 2991;

        $sql = "INSERT INTO `cafeteria` (`food_type`, `seating`)
                VALUES (?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->foodType,
                $this->dto->seating
            ]);
        $this->db->expects($this->once())
            ->method("lastInsertId")
            ->willReturn($expected);

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 416;

        $sql = "UPDATE `cafeteria` SET `food_type` = ?, `seating` = ?
                WHERE `cafeteria_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->foodType,
                $this->dto->seating,
                $this->dto->cafeteriaId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $cafeteriaId = 1923;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($cafeteriaId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $cafeteriaId = 3228;

        $sql = "SELECT `cafeteria_id`, `food_type`, `seating`
                FROM `cafeteria` WHERE `cafeteria_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$cafeteriaId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($cafeteriaId);
        $this->assertEquals($this->dto, $actual);
    }

    public function testGetAll_ReturnsEmptyOnException(): void
    {
        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsDtos(): void
    {
        $sql = "SELECT `cafeteria_id`, `food_type`, `seating`
                FROM `cafeteria`";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute");
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->getAll();
        $this->assertEquals([$this->dto], $actual);
    }

    public function testDelete_ReturnsFailedOnException(): void
    {
        $cafeteriaId = 171;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($cafeteriaId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $cafeteriaId = 6417;
        $expected = 543;

        $sql = "DELETE FROM `cafeteria` WHERE `cafeteria_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$cafeteriaId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($cafeteriaId);
        $this->assertEquals($expected, $actual);
    }
}