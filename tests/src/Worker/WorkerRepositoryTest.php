<?php

declare(strict_types=1);

namespace Hospital\Tests\Worker;

use PHPUnit\Framework\TestCase;
use Hospital\Database\DatabaseException;
use Hospital\Worker\{ WorkerDto, IWorkerRepository, WorkerRepository };

class WorkerRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private WorkerDto $dto;
    private IWorkerRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Hospital\Database\IDatabase");
        $this->result = $this->createMock("Hospital\Database\IDatabaseResult");
        $this->input = [
            "worker_id" => 6754,
            "first_name" => "cultural",
            "last_name" => "reduce",
            "gender" => "through",
            "telephone" => "what",
            "salary" => 641.66,
        ];
        $this->dto = new WorkerDto($this->input);
        $this->repository = new WorkerRepository($this->db);
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
        $expected = 8479;

        $sql = "INSERT INTO `worker` (`first_name`, `last_name`, `gender`, `telephone`, `salary`)
                VALUES (?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->firstName,
                $this->dto->lastName,
                $this->dto->gender,
                $this->dto->telephone,
                $this->dto->salary
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
        $expected = 2352;

        $sql = "UPDATE `worker` SET `first_name` = ?, `last_name` = ?, `gender` = ?, `telephone` = ?, `salary` = ?
                WHERE `worker_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->firstName,
                $this->dto->lastName,
                $this->dto->gender,
                $this->dto->telephone,
                $this->dto->salary,
                $this->dto->workerId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $workerId = 9502;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($workerId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $workerId = 8653;

        $sql = "SELECT `worker_id`, `first_name`, `last_name`, `gender`, `telephone`, `salary`
                FROM `worker` WHERE `worker_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$workerId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($workerId);
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
        $sql = "SELECT `worker_id`, `first_name`, `last_name`, `gender`, `telephone`, `salary`
                FROM `worker`";

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
        $workerId = 8206;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($workerId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $workerId = 3457;
        $expected = 4536;

        $sql = "DELETE FROM `worker` WHERE `worker_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$workerId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($workerId);
        $this->assertEquals($expected, $actual);
    }
}