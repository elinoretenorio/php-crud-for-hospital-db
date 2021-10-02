<?php

declare(strict_types=1);

namespace Hospital\Tests;

use Hospital\Database\IDatabase;
use Hospital\Database\DatabaseException;

class TestsRepository implements ITestsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(TestsDto $dto): int
    {
        $sql = "INSERT INTO `tests` (`result`, `illness`, `doctor_id`, `patient_id`)
                VALUES (?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->result,
                $dto->illness,
                $dto->doctorId,
                $dto->patientId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(TestsDto $dto): int
    {
        $sql = "UPDATE `tests` SET `result` = ?, `illness` = ?, `doctor_id` = ?, `patient_id` = ?
                WHERE `test_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->result,
                $dto->illness,
                $dto->doctorId,
                $dto->patientId,
                $dto->testId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $testId): ?TestsDto
    {
        $sql = "SELECT `test_id`, `result`, `illness`, `doctor_id`, `patient_id`
                FROM `tests` WHERE `test_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$testId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new TestsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `test_id`, `result`, `illness`, `doctor_id`, `patient_id`
                FROM `tests`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new TestsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $testId): int
    {
        $sql = "DELETE FROM `tests` WHERE `test_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$testId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}