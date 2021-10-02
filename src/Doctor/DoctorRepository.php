<?php

declare(strict_types=1);

namespace Hospital\Doctor;

use Hospital\Database\IDatabase;
use Hospital\Database\DatabaseException;

class DoctorRepository implements IDoctorRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(DoctorDto $dto): int
    {
        $sql = "INSERT INTO `doctor` (`field`, `degree`, `department_id`, `worker_id`)
                VALUES (?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->field,
                $dto->degree,
                $dto->departmentId,
                $dto->workerId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(DoctorDto $dto): int
    {
        $sql = "UPDATE `doctor` SET `field` = ?, `degree` = ?, `department_id` = ?, `worker_id` = ?
                WHERE `doctor_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->field,
                $dto->degree,
                $dto->departmentId,
                $dto->workerId,
                $dto->doctorId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $doctorId): ?DoctorDto
    {
        $sql = "SELECT `doctor_id`, `field`, `degree`, `department_id`, `worker_id`
                FROM `doctor` WHERE `doctor_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$doctorId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new DoctorDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `doctor_id`, `field`, `degree`, `department_id`, `worker_id`
                FROM `doctor`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new DoctorDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $doctorId): int
    {
        $sql = "DELETE FROM `doctor` WHERE `doctor_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$doctorId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}