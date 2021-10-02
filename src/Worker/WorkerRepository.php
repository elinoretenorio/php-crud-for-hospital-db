<?php

declare(strict_types=1);

namespace Hospital\Worker;

use Hospital\Database\IDatabase;
use Hospital\Database\DatabaseException;

class WorkerRepository implements IWorkerRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(WorkerDto $dto): int
    {
        $sql = "INSERT INTO `worker` (`first_name`, `last_name`, `gender`, `telephone`, `salary`)
                VALUES (?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->firstName,
                $dto->lastName,
                $dto->gender,
                $dto->telephone,
                $dto->salary
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(WorkerDto $dto): int
    {
        $sql = "UPDATE `worker` SET `first_name` = ?, `last_name` = ?, `gender` = ?, `telephone` = ?, `salary` = ?
                WHERE `worker_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->firstName,
                $dto->lastName,
                $dto->gender,
                $dto->telephone,
                $dto->salary,
                $dto->workerId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $workerId): ?WorkerDto
    {
        $sql = "SELECT `worker_id`, `first_name`, `last_name`, `gender`, `telephone`, `salary`
                FROM `worker` WHERE `worker_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$workerId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new WorkerDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `worker_id`, `first_name`, `last_name`, `gender`, `telephone`, `salary`
                FROM `worker`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new WorkerDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $workerId): int
    {
        $sql = "DELETE FROM `worker` WHERE `worker_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$workerId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}