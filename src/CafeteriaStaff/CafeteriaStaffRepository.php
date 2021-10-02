<?php

declare(strict_types=1);

namespace Hospital\CafeteriaStaff;

use Hospital\Database\IDatabase;
use Hospital\Database\DatabaseException;

class CafeteriaStaffRepository implements ICafeteriaStaffRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(CafeteriaStaffDto $dto): int
    {
        $sql = "INSERT INTO `cafeteria_staff` (`staff_id`, `cafeteria_id`, `position`)
                VALUES (?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->staffId,
                $dto->cafeteriaId,
                $dto->position
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(CafeteriaStaffDto $dto): int
    {
        $sql = "UPDATE `cafeteria_staff` SET `staff_id` = ?, `cafeteria_id` = ?, `position` = ?
                WHERE `cafetria_staff_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->staffId,
                $dto->cafeteriaId,
                $dto->position,
                $dto->cafetriaStaffId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $cafetriaStaffId): ?CafeteriaStaffDto
    {
        $sql = "SELECT `cafetria_staff_id`, `staff_id`, `cafeteria_id`, `position`
                FROM `cafeteria_staff` WHERE `cafetria_staff_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$cafetriaStaffId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new CafeteriaStaffDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `cafetria_staff_id`, `staff_id`, `cafeteria_id`, `position`
                FROM `cafeteria_staff`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new CafeteriaStaffDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $cafetriaStaffId): int
    {
        $sql = "DELETE FROM `cafeteria_staff` WHERE `cafetria_staff_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$cafetriaStaffId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}