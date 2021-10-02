<?php

declare(strict_types=1);

namespace Hospital\Patient;

use Hospital\Database\IDatabase;
use Hospital\Database\DatabaseException;

class PatientRepository implements IPatientRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(PatientDto $dto): int
    {
        $sql = "INSERT INTO `patient` (`first_name`, `last_name`, `address`, `telephone`, `gender`, `age`, `blood_type`, `cafeteria_id`, `bill_id`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->firstName,
                $dto->lastName,
                $dto->address,
                $dto->telephone,
                $dto->gender,
                $dto->age,
                $dto->bloodType,
                $dto->cafeteriaId,
                $dto->billId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(PatientDto $dto): int
    {
        $sql = "UPDATE `patient` SET `first_name` = ?, `last_name` = ?, `address` = ?, `telephone` = ?, `gender` = ?, `age` = ?, `blood_type` = ?, `cafeteria_id` = ?, `bill_id` = ?
                WHERE `patient_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->firstName,
                $dto->lastName,
                $dto->address,
                $dto->telephone,
                $dto->gender,
                $dto->age,
                $dto->bloodType,
                $dto->cafeteriaId,
                $dto->billId,
                $dto->patientId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $patientId): ?PatientDto
    {
        $sql = "SELECT `patient_id`, `first_name`, `last_name`, `address`, `telephone`, `gender`, `age`, `blood_type`, `cafeteria_id`, `bill_id`
                FROM `patient` WHERE `patient_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$patientId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new PatientDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `patient_id`, `first_name`, `last_name`, `address`, `telephone`, `gender`, `age`, `blood_type`, `cafeteria_id`, `bill_id`
                FROM `patient`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new PatientDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $patientId): int
    {
        $sql = "DELETE FROM `patient` WHERE `patient_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$patientId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}