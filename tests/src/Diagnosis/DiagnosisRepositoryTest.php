<?php

declare(strict_types=1);

namespace Hospital\Tests\Diagnosis;

use PHPUnit\Framework\TestCase;
use Hospital\Database\DatabaseException;
use Hospital\Diagnosis\{ DiagnosisDto, IDiagnosisRepository, DiagnosisRepository };

class DiagnosisRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private DiagnosisDto $dto;
    private IDiagnosisRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Hospital\Database\IDatabase");
        $this->result = $this->createMock("Hospital\Database\IDatabaseResult");
        $this->input = [
            "diagnosis_id" => 981,
            "illness" => "police",
            "doctor_id" => 2632,
            "patient_id" => 1400,
        ];
        $this->dto = new DiagnosisDto($this->input);
        $this->repository = new DiagnosisRepository($this->db);
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
        $expected = 916;

        $sql = "INSERT INTO `diagnosis` (`illness`, `doctor_id`, `patient_id`)
                VALUES (?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->illness,
                $this->dto->doctorId,
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
        $expected = 7488;

        $sql = "UPDATE `diagnosis` SET `illness` = ?, `doctor_id` = ?, `patient_id` = ?
                WHERE `diagnosis_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->illness,
                $this->dto->doctorId,
                $this->dto->patientId,
                $this->dto->diagnosisId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $diagnosisId = 8866;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($diagnosisId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $diagnosisId = 5579;

        $sql = "SELECT `diagnosis_id`, `illness`, `doctor_id`, `patient_id`
                FROM `diagnosis` WHERE `diagnosis_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$diagnosisId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($diagnosisId);
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
        $sql = "SELECT `diagnosis_id`, `illness`, `doctor_id`, `patient_id`
                FROM `diagnosis`";

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
        $diagnosisId = 4807;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($diagnosisId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $diagnosisId = 63;
        $expected = 4771;

        $sql = "DELETE FROM `diagnosis` WHERE `diagnosis_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$diagnosisId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($diagnosisId);
        $this->assertEquals($expected, $actual);
    }
}