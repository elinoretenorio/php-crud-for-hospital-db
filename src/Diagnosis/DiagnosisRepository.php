<?php

declare(strict_types=1);

namespace Hospital\Diagnosis;

use Hospital\Database\IDatabase;
use Hospital\Database\DatabaseException;

class DiagnosisRepository implements IDiagnosisRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(DiagnosisDto $dto): int
    {
        $sql = "INSERT INTO `diagnosis` (`illness`, `doctor_id`, `patient_id`)
                VALUES (?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->illness,
                $dto->doctorId,
                $dto->patientId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(DiagnosisDto $dto): int
    {
        $sql = "UPDATE `diagnosis` SET `illness` = ?, `doctor_id` = ?, `patient_id` = ?
                WHERE `diagnosis_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->illness,
                $dto->doctorId,
                $dto->patientId,
                $dto->diagnosisId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $diagnosisId): ?DiagnosisDto
    {
        $sql = "SELECT `diagnosis_id`, `illness`, `doctor_id`, `patient_id`
                FROM `diagnosis` WHERE `diagnosis_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$diagnosisId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new DiagnosisDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `diagnosis_id`, `illness`, `doctor_id`, `patient_id`
                FROM `diagnosis`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new DiagnosisDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $diagnosisId): int
    {
        $sql = "DELETE FROM `diagnosis` WHERE `diagnosis_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$diagnosisId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}