<?php

declare(strict_types=1);

namespace Hospital\Patient;

use JsonSerializable;

class PatientModel implements JsonSerializable
{
    private int $patientId;
    private string $firstName;
    private string $lastName;
    private string $address;
    private string $telephone;
    private string $gender;
    private int $age;
    private string $bloodType;
    private string $cafeteriaId;
    private int $billId;

    public function __construct(PatientDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->patientId = $dto->patientId;
        $this->firstName = $dto->firstName;
        $this->lastName = $dto->lastName;
        $this->address = $dto->address;
        $this->telephone = $dto->telephone;
        $this->gender = $dto->gender;
        $this->age = $dto->age;
        $this->bloodType = $dto->bloodType;
        $this->cafeteriaId = $dto->cafeteriaId;
        $this->billId = $dto->billId;
    }

    public function getPatientId(): int
    {
        return $this->patientId;
    }

    public function setPatientId(int $patientId): void
    {
        $this->patientId = $patientId;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): void
    {
        $this->telephone = $telephone;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    public function getBloodType(): string
    {
        return $this->bloodType;
    }

    public function setBloodType(string $bloodType): void
    {
        $this->bloodType = $bloodType;
    }

    public function getCafeteriaId(): string
    {
        return $this->cafeteriaId;
    }

    public function setCafeteriaId(string $cafeteriaId): void
    {
        $this->cafeteriaId = $cafeteriaId;
    }

    public function getBillId(): int
    {
        return $this->billId;
    }

    public function setBillId(int $billId): void
    {
        $this->billId = $billId;
    }

    public function toDto(): PatientDto
    {
        $dto = new PatientDto();
        $dto->patientId = (int) ($this->patientId ?? 0);
        $dto->firstName = $this->firstName ?? "";
        $dto->lastName = $this->lastName ?? "";
        $dto->address = $this->address ?? "";
        $dto->telephone = $this->telephone ?? "";
        $dto->gender = $this->gender ?? "";
        $dto->age = (int) ($this->age ?? 0);
        $dto->bloodType = $this->bloodType ?? "";
        $dto->cafeteriaId = $this->cafeteriaId ?? "";
        $dto->billId = (int) ($this->billId ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "patient_id" => $this->patientId,
            "first_name" => $this->firstName,
            "last_name" => $this->lastName,
            "address" => $this->address,
            "telephone" => $this->telephone,
            "gender" => $this->gender,
            "age" => $this->age,
            "blood_type" => $this->bloodType,
            "cafeteria_id" => $this->cafeteriaId,
            "bill_id" => $this->billId,
        ];
    }
}