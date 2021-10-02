<?php

declare(strict_types=1);

namespace Hospital\Worker;

class WorkerDto 
{
    public int $workerId;
    public string $firstName;
    public string $lastName;
    public string $gender;
    public string $telephone;
    public float $salary;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->workerId = (int) ($row["worker_id"] ?? 0);
        $this->firstName = $row["first_name"] ?? "";
        $this->lastName = $row["last_name"] ?? "";
        $this->gender = $row["gender"] ?? "";
        $this->telephone = $row["telephone"] ?? "";
        $this->salary = (float) ($row["salary"] ?? 0);
    }
}