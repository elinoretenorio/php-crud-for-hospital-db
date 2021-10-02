<?php

declare(strict_types=1);

namespace Hospital\Tests\Patient;

use PHPUnit\Framework\TestCase;
use Hospital\Database\DatabaseException;
use Hospital\Patient\{ PatientDto, IPatientRepository, PatientRepository };

class PatientRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private PatientDto $dto;
    private IPatientRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Hospital\Database\IDatabase");
        $this->result = $this->createMock("Hospital\Database\IDatabaseResult");
        $this->input = [
            "patient_id" => 2754,
            "first_name" => "order",
            "last_name" => "argue",
            "address" => "Pattern of several my play ask section.",
            "telephone" => "group",
            "gender" => "establish",
            "age" => 3708,
            "blood_type" => "top",
            "cafeteria_id" => "certain",
            "bill_id" => 9368,
        ];
        $this->dto = new PatientDto($this->input);
        $this->repository = new PatientRepository($this->db);
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
        $expected = 3797;

        $sql = "INSERT INTO `patient` (`first_name`, `last_name`, `address`, `telephone`, `gender`, `age`, `blood_type`, `cafeteria_id`, `bill_id`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->firstName,
                $this->dto->lastName,
                $this->dto->address,
                $this->dto->telephone,
                $this->dto->gender,
                $this->dto->age,
                $this->dto->bloodType,
                $this->dto->cafeteriaId,
                $this->dto->billId
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
        $expected = 4832;

        $sql = "UPDATE `patient` SET `first_name` = ?, `last_name` = ?, `address` = ?, `telephone` = ?, `gender` = ?, `age` = ?, `blood_type` = ?, `cafeteria_id` = ?, `bill_id` = ?
                WHERE `patient_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->firstName,
                $this->dto->lastName,
                $this->dto->address,
                $this->dto->telephone,
                $this->dto->gender,
                $this->dto->age,
                $this->dto->bloodType,
                $this->dto->cafeteriaId,
                $this->dto->billId,
                $this->dto->patientId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $patientId = 2828;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($patientId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $patientId = 4974;

        $sql = "SELECT `patient_id`, `first_name`, `last_name`, `address`, `telephone`, `gender`, `age`, `blood_type`, `cafeteria_id`, `bill_id`
                FROM `patient` WHERE `patient_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$patientId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($patientId);
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
        $sql = "SELECT `patient_id`, `first_name`, `last_name`, `address`, `telephone`, `gender`, `age`, `blood_type`, `cafeteria_id`, `bill_id`
                FROM `patient`";

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
        $patientId = 1296;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($patientId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $patientId = 2172;
        $expected = 1059;

        $sql = "DELETE FROM `patient` WHERE `patient_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$patientId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($patientId);
        $this->assertEquals($expected, $actual);
    }
}