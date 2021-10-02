<?php

declare(strict_types=1);

namespace Hospital\Tests;

class TestsDto 
{
    public int $testId;
    public int $result;
    public string $illness;
    public int $doctorId;
    public int $patientId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->testId = (int) ($row["test_id"] ?? 0);
        $this->result = (int) ($row["result"] ?? 0);
        $this->illness = $row["illness"] ?? "";
        $this->doctorId = (int) ($row["doctor_id"] ?? 0);
        $this->patientId = (int) ($row["patient_id"] ?? 0);
    }
}