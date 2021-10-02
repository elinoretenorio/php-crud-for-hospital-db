<?php

declare(strict_types=1);

namespace Hospital\Patient;

class PatientDto 
{
    public int $patientId;
    public string $firstName;
    public string $lastName;
    public string $address;
    public string $telephone;
    public string $gender;
    public int $age;
    public string $bloodType;
    public string $cafeteriaId;
    public int $billId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->patientId = (int) ($row["patient_id"] ?? 0);
        $this->firstName = $row["first_name"] ?? "";
        $this->lastName = $row["last_name"] ?? "";
        $this->address = $row["address"] ?? "";
        $this->telephone = $row["telephone"] ?? "";
        $this->gender = $row["gender"] ?? "";
        $this->age = (int) ($row["age"] ?? 0);
        $this->bloodType = $row["blood_type"] ?? "";
        $this->cafeteriaId = $row["cafeteria_id"] ?? "";
        $this->billId = (int) ($row["bill_id"] ?? 0);
    }
}