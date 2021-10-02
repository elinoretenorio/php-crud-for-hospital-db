<?php

declare(strict_types=1);

namespace Hospital\Tests\DoctorPatient;

use PHPUnit\Framework\TestCase;
use Hospital\Database\DatabaseException;
use Hospital\DoctorPatient\{ DoctorPatientDto, IDoctorPatientRepository, DoctorPatientRepository };

class DoctorPatientRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private DoctorPatientDto $dto;
    private IDoctorPatientRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Hospital\Database\IDatabase");
        $this->result = $this->createMock("Hospital\Database\IDatabaseResult");
        $this->input = [
            "doctor_patient_id" => 3359,
            "doctor_id" => 5329,
            "patient_id" => 9269,
            "examination_date" => "2021-10-02",
        ];
        $this->dto = new DoctorPatientDto($this->input);
        $this->repository = new DoctorPatientRepository($this->db);
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
        $expected = 3880;

        $sql = "INSERT INTO `doctor_patient` (`doctor_id`, `patient_id`, `examination_date`)
                VALUES (?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->doctorId,
                $this->dto->patientId,
                $this->dto->examinationDate
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
        $expected = 6751;

        $sql = "UPDATE `doctor_patient` SET `doctor_id` = ?, `patient_id` = ?, `examination_date` = ?
                WHERE `doctor_patient_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->doctorId,
                $this->dto->patientId,
                $this->dto->examinationDate,
                $this->dto->doctorPatientId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $doctorPatientId = 6482;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($doctorPatientId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $doctorPatientId = 9317;

        $sql = "SELECT `doctor_patient_id`, `doctor_id`, `patient_id`, `examination_date`
                FROM `doctor_patient` WHERE `doctor_patient_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$doctorPatientId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($doctorPatientId);
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
        $sql = "SELECT `doctor_patient_id`, `doctor_id`, `patient_id`, `examination_date`
                FROM `doctor_patient`";

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
        $doctorPatientId = 1594;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($doctorPatientId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $doctorPatientId = 5544;
        $expected = 9576;

        $sql = "DELETE FROM `doctor_patient` WHERE `doctor_patient_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$doctorPatientId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($doctorPatientId);
        $this->assertEquals($expected, $actual);
    }
}