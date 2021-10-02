<?php

declare(strict_types=1);

namespace Hospital\Doctor;

class DoctorDto 
{
    public int $doctorId;
    public string $field;
    public string $degree;
    public string $departmentId;
    public int $workerId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->doctorId = (int) ($row["doctor_id"] ?? 0);
        $this->field = $row["field"] ?? "";
        $this->degree = $row["degree"] ?? "";
        $this->departmentId = $row["department_id"] ?? "";
        $this->workerId = (int) ($row["worker_id"] ?? 0);
    }
}