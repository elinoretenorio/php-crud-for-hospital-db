<?php

declare(strict_types=1);

namespace Hospital\Tests\MedicationPrescribed;

use PHPUnit\Framework\TestCase;
use Hospital\Database\DatabaseException;
use Hospital\MedicationPrescribed\{ MedicationPrescribedDto, IMedicationPrescribedRepository, MedicationPrescribedRepository };

class MedicationPrescribedRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private MedicationPrescribedDto $dto;
    private IMedicationPrescribedRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Hospital\Database\IDatabase");
        $this->result = $this->createMock("Hospital\Database\IDatabaseResult");
        $this->input = [
            "medication_prescribed_id" => 164,
            "prescription_id" => 9715,
            "medication_id" => "continue",
            "patient_id" => 7516,
        ];
        $this->dto = new MedicationPrescribedDto($this->input);
        $this->repository = new MedicationPrescribedRepository($this->db);
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
        $expected = 1680;

        $sql = "INSERT INTO `medication_prescribed` (`prescription_id`, `medication_id`, `patient_id`)
                VALUES (?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->prescriptionId,
                $this->dto->medicationId,
                $this->dto->patientId
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
        $expected = 7365;

        $sql = "UPDATE `medication_prescribed` SET `prescription_id` = ?, `medication_id` = ?, `patient_id` = ?
                WHERE `medication_prescribed_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->prescriptionId,
                $this->dto->medicationId,
                $this->dto->patientId,
                $this->dto->medicationPrescribedId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $medicationPrescribedId = 3998;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($medicationPrescribedId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $medicationPrescribedId = 6380;

        $sql = "SELECT `medication_prescribed_id`, `prescription_id`, `medication_id`, `patient_id`
                FROM `medication_prescribed` WHERE `medication_prescribed_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$medicationPrescribedId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($medicationPrescribedId);
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
        $sql = "SELECT `medication_prescribed_id`, `prescription_id`, `medication_id`, `patient_id`
                FROM `medication_prescribed`";

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
        $medicationPrescribedId = 3501;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($medicationPrescribedId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $medicationPrescribedId = 3463;
        $expected = 9273;

        $sql = "DELETE FROM `medication_prescribed` WHERE `medication_prescribed_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$medicationPrescribedId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($medicationPrescribedId);
        $this->assertEquals($expected, $actual);
    }
}