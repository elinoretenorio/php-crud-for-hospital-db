<?php

declare(strict_types=1);

namespace Hospital\DoctorPatient;

use Hospital\Database\IDatabase;
use Hospital\Database\DatabaseException;

class DoctorPatientRepository implements IDoctorPatientRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(DoctorPatientDto $dto): int
    {
        $sql = "INSERT INTO `doctor_patient` (`doctor_id`, `patient_id`, `examination_date`)
                VALUES (?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->doctorId,
                $dto->patientId,
                $dto->examinationDate
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(DoctorPatientDto $dto): int
    {
        $sql = "UPDATE `doctor_patient` SET `doctor_id` = ?, `patient_id` = ?, `examination_date` = ?
                WHERE `doctor_patient_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->doctorId,
                $dto->patientId,
                $dto->examinationDate,
                $dto->doctorPatientId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $doctorPatientId): ?DoctorPatientDto
    {
        $sql = "SELECT `doctor_patient_id`, `doctor_id`, `patient_id`, `examination_date`
                FROM `doctor_patient` WHERE `doctor_patient_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$doctorPatientId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new DoctorPatientDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `doctor_patient_id`, `doctor_id`, `patient_id`, `examination_date`
                FROM `doctor_patient`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new DoctorPatientDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $doctorPatientId): int
    {
        $sql = "DELETE FROM `doctor_patient` WHERE `doctor_patient_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$doctorPatientId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}