<?php

declare(strict_types=1);

namespace Hospital\Tests\Doctor;

use PHPUnit\Framework\TestCase;
use Hospital\Database\DatabaseException;
use Hospital\Doctor\{ DoctorDto, IDoctorRepository, DoctorRepository };

class DoctorRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private DoctorDto $dto;
    private IDoctorRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Hospital\Database\IDatabase");
        $this->result = $this->createMock("Hospital\Database\IDatabaseResult");
        $this->input = [
            "doctor_id" => 4185,
            "field" => "always",
            "degree" => "long",
            "department_id" => "support",
            "worker_id" => 7107,
        ];
        $this->dto = new DoctorDto($this->input);
        $this->repository = new DoctorRepository($this->db);
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
        $expected = 2429;

        $sql = "INSERT INTO `doctor` (`field`, `degree`, `department_id`, `worker_id`)
                VALUES (?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->field,
                $this->dto->degree,
                $this->dto->departmentId,
                $this->dto->workerId
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
        $expected = 3340;

        $sql = "UPDATE `doctor` SET `field` = ?, `degree` = ?, `department_id` = ?, `worker_id` = ?
                WHERE `doctor_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->field,
                $this->dto->degree,
                $this->dto->departmentId,
                $this->dto->workerId,
                $this->dto->doctorId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $doctorId = 2830;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($doctorId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $doctorId = 1331;

        $sql = "SELECT `doctor_id`, `field`, `degree`, `department_id`, `worker_id`
                FROM `doctor` WHERE `doctor_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$doctorId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($doctorId);
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
        $sql = "SELECT `doctor_id`, `field`, `degree`, `department_id`, `worker_id`
                FROM `doctor`";

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
        $doctorId = 9655;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($doctorId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $doctorId = 378;
        $expected = 5795;

        $sql = "DELETE FROM `doctor` WHERE `doctor_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$doctorId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($doctorId);
        $this->assertEquals($expected, $actual);
    }
}