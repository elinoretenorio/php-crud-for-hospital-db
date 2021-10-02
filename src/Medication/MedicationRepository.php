<?php

declare(strict_types=1);

namespace Hospital\Medication;

use Hospital\Database\IDatabase;
use Hospital\Database\DatabaseException;

class MedicationRepository implements IMedicationRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(MedicationDto $dto): int
    {
        $sql = "INSERT INTO `medication` (`doses`, `expiration_date`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->doses,
                $dto->expirationDate
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(MedicationDto $dto): int
    {
        $sql = "UPDATE `medication` SET `doses` = ?, `expiration_date` = ?
                WHERE `medication_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->doses,
                $dto->expirationDate,
                $dto->medicationId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $medicationId): ?MedicationDto
    {
        $sql = "SELECT `medication_id`, `doses`, `expiration_date`
                FROM `medication` WHERE `medication_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$medicationId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new MedicationDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `medication_id`, `doses`, `expiration_date`
                FROM `medication`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new MedicationDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $medicationId): int
    {
        $sql = "DELETE FROM `medication` WHERE `medication_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$medicationId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}