<?php

declare(strict_types=1);

namespace Hospital\Diagnosis;

class DiagnosisDto 
{
    public int $diagnosisId;
    public string $illness;
    public int $doctorId;
    public int $patientId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->diagnosisId = (int) ($row["diagnosis_id"] ?? 0);
        $this->illness = $row["illness"] ?? "";
        $this->doctorId = (int) ($row["doctor_id"] ?? 0);
        $this->patientId = (int) ($row["patient_id"] ?? 0);
    }
}