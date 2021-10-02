<?php

declare(strict_types=1);

namespace Hospital\Staff;

use Hospital\Database\IDatabase;
use Hospital\Database\DatabaseException;

class StaffRepository implements IStaffRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(StaffDto $dto): int
    {
        $sql = "INSERT INTO `staff` (`job_title`, `worker_id`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->jobTitle,
                $dto->workerId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(StaffDto $dto): int
    {
        $sql = "UPDATE `staff` SET `job_title` = ?, `worker_id` = ?
                WHERE `staff_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->jobTitle,
                $dto->workerId,
                $dto->staffId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $staffId): ?StaffDto
    {
        $sql = "SELECT `staff_id`, `job_title`, `worker_id`
                FROM `staff` WHERE `staff_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$staffId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new StaffDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `staff_id`, `job_title`, `worker_id`
                FROM `staff`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new StaffDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $staffId): int
    {
        $sql = "DELETE FROM `staff` WHERE `staff_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$staffId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}