<?php

declare(strict_types=1);

namespace Hospital\MedicationPrescribed;

class MedicationPrescribedDto 
{
    public int $medicationPrescribedId;
    public int $prescriptionId;
    public string $medicationId;
    public int $patientId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->medicationPrescribedId = (int) ($row["medication_prescribed_id"] ?? 0);
        $this->prescriptionId = (int) ($row["prescription_id"] ?? 0);
        $this->medicationId = $row["medication_id"] ?? "";
        $this->patientId = (int) ($row["patient_id"] ?? 0);
    }
}