<?php

declare(strict_types=1);

namespace Hospital\Department;

use Hospital\Database\IDatabase;
use Hospital\Database\DatabaseException;

class DepartmentRepository implements IDepartmentRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(DepartmentDto $dto): int
    {
        $sql = "INSERT INTO `department` (`workers`, `building_location`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->workers,
                $dto->buildingLocation
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(DepartmentDto $dto): int
    {
        $sql = "UPDATE `department` SET `workers` = ?, `building_location` = ?
                WHERE `department_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->workers,
                $dto->buildingLocation,
                $dto->departmentId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $departmentId): ?DepartmentDto
    {
        $sql = "SELECT `department_id`, `workers`, `building_location`
                FROM `department` WHERE `department_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$departmentId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new DepartmentDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `department_id`, `workers`, `building_location`
                FROM `department`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new DepartmentDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $departmentId): int
    {
        $sql = "DELETE FROM `department` WHERE `department_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$departmentId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}