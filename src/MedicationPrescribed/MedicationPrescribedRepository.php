<?php

declare(strict_types=1);

namespace Hospital\MedicationPrescribed;

use Hospital\Database\IDatabase;
use Hospital\Database\DatabaseException;

class MedicationPrescribedRepository implements IMedicationPrescribedRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(MedicationPrescribedDto $dto): int
    {
        $sql = "INSERT INTO `medication_prescribed` (`prescription_id`, `medication_id`, `patient_id`)
                VALUES (?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->prescriptionId,
                $dto->medicationId,
                $dto->patientId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(MedicationPrescribedDto $dto): int
    {
        $sql = "UPDATE `medication_prescribed` SET `prescription_id` = ?, `medication_id` = ?, `patient_id` = ?
                WHERE `medication_prescribed_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->prescriptionId,
                $dto->medicationId,
                $dto->patientId,
                $dto->medicationPrescribedId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $medicationPrescribedId): ?MedicationPrescribedDto
    {
        $sql = "SELECT `medication_prescribed_id`, `prescription_id`, `medication_id`, `patient_id`
                FROM `medication_prescribed` WHERE `medication_prescribed_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$medicationPrescribedId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new MedicationPrescribedDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `medication_prescribed_id`, `prescription_id`, `medication_id`, `patient_id`
                FROM `medication_prescribed`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new MedicationPrescribedDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $medicationPrescribedId): int
    {
        $sql = "DELETE FROM `medication_prescribed` WHERE `medication_prescribed_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$medicationPrescribedId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}