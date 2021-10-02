<?php

declare(strict_types=1);

namespace Hospital\Medication;

class MedicationDto 
{
    public int $medicationId;
    public int $doses;
    public string $expirationDate;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->medicationId = (int) ($row["medication_id"] ?? 0);
        $this->doses = (int) ($row["doses"] ?? 0);
        $this->expirationDate = $row["expiration_date"] ?? "";
    }
}