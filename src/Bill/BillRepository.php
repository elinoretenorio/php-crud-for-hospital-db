<?php

declare(strict_types=1);

namespace Hospital\Bill;

use Hospital\Database\IDatabase;
use Hospital\Database\DatabaseException;

class BillRepository implements IBillRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(BillDto $dto): int
    {
        $sql = "INSERT INTO `bill` (`tests`, `treatment`, `time_admitted`, `prescription`)
                VALUES (?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->tests,
                $dto->treatment,
                $dto->timeAdmitted,
                $dto->prescription
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(BillDto $dto): int
    {
        $sql = "UPDATE `bill` SET `tests` = ?, `treatment` = ?, `time_admitted` = ?, `prescription` = ?
                WHERE `bill_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->tests,
                $dto->treatment,
                $dto->timeAdmitted,
                $dto->prescription,
                $dto->billId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $billId): ?BillDto
    {
        $sql = "SELECT `bill_id`, `tests`, `treatment`, `time_admitted`, `prescription`
                FROM `bill` WHERE `bill_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$billId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new BillDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `bill_id`, `tests`, `treatment`, `time_admitted`, `prescription`
                FROM `bill`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new BillDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $billId): int
    {
        $sql = "DELETE FROM `bill` WHERE `bill_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$billId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}