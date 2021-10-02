<?php

declare(strict_types=1);

namespace Hospital\Cafeteria;

use Hospital\Database\IDatabase;
use Hospital\Database\DatabaseException;

class CafeteriaRepository implements ICafeteriaRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(CafeteriaDto $dto): int
    {
        $sql = "INSERT INTO `cafeteria` (`food_type`, `seating`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->foodType,
                $dto->seating
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(CafeteriaDto $dto): int
    {
        $sql = "UPDATE `cafeteria` SET `food_type` = ?, `seating` = ?
                WHERE `cafeteria_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->foodType,
                $dto->seating,
                $dto->cafeteriaId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $cafeteriaId): ?CafeteriaDto
    {
        $sql = "SELECT `cafeteria_id`, `food_type`, `seating`
                FROM `cafeteria` WHERE `cafeteria_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$cafeteriaId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new CafeteriaDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `cafeteria_id`, `food_type`, `seating`
                FROM `cafeteria`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new CafeteriaDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $cafeteriaId): int
    {
        $sql = "DELETE FROM `cafeteria` WHERE `cafeteria_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$cafeteriaId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}