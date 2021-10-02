<?php

declare(strict_types=1);

namespace Hospital\Tests\CafeteriaStaff;

use PHPUnit\Framework\TestCase;
use Hospital\Database\DatabaseException;
use Hospital\CafeteriaStaff\{ CafeteriaStaffDto, ICafeteriaStaffRepository, CafeteriaStaffRepository };

class CafeteriaStaffRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private CafeteriaStaffDto $dto;
    private ICafeteriaStaffRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Hospital\Database\IDatabase");
        $this->result = $this->createMock("Hospital\Database\IDatabaseResult");
        $this->input = [
            "cafetria_staff_id" => 1943,
            "staff_id" => 1338,
            "cafeteria_id" => "treat",
            "position" => "least",
        ];
        $this->dto = new CafeteriaStaffDto($this->input);
        $this->repository = new CafeteriaStaffRepository($this->db);
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
        $expected = 3710;

        $sql = "INSERT INTO `cafeteria_staff` (`staff_id`, `cafeteria_id`, `position`)
                VALUES (?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->staffId,
                $this->dto->cafeteriaId,
                $this->dto->position
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
        $expected = 1159;

        $sql = "UPDATE `cafeteria_staff` SET `staff_id` = ?, `cafeteria_id` = ?, `position` = ?
                WHERE `cafetria_staff_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->staffId,
                $this->dto->cafeteriaId,
                $this->dto->position,
                $this->dto->cafetriaStaffId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $cafetriaStaffId = 4003;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($cafetriaStaffId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $cafetriaStaffId = 3853;

        $sql = "SELECT `cafetria_staff_id`, `staff_id`, `cafeteria_id`, `position`
                FROM `cafeteria_staff` WHERE `cafetria_staff_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$cafetriaStaffId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($cafetriaStaffId);
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
        $sql = "SELECT `cafetria_staff_id`, `staff_id`, `cafeteria_id`, `position`
                FROM `cafeteria_staff`";

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
        $cafetriaStaffId = 4376;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($cafetriaStaffId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $cafetriaStaffId = 7833;
        $expected = 91;

        $sql = "DELETE FROM `cafeteria_staff` WHERE `cafetria_staff_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$cafetriaStaffId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($cafetriaStaffId);
        $this->assertEquals($expected, $actual);
    }
}