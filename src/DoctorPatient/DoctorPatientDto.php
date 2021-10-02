<?php

declare(strict_types=1);

namespace Hospital\DoctorPatient;

class DoctorPatientDto 
{
    public int $doctorPatientId;
    public int $doctorId;
    public int $patientId;
    public string $examinationDate;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->doctorPatientId = (int) ($row["doctor_patient_id"] ?? 0);
        $this->doctorId = (int) ($row["doctor_id"] ?? 0);
        $this->patientId = (int) ($row["patient_id"] ?? 0);
        $this->examinationDate = $row["examination_date"] ?? "";
    }
}