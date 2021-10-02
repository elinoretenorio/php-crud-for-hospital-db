<?php

declare(strict_types=1);

namespace Hospital\DoctorPatient;

use JsonSerializable;

class DoctorPatientModel implements JsonSerializable
{
    private int $doctorPatientId;
    private int $doctorId;
    private int $patientId;
    private string $examinationDate;

    public function __construct(DoctorPatientDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->doctorPatientId = $dto->doctorPatientId;
        $this->doctorId = $dto->doctorId;
        $this->patientId = $dto->patientId;
        $this->examinationDate = $dto->examinationDate;
    }

    public function getDoctorPatientId(): int
    {
        return $this->doctorPatientId;
    }

    public function setDoctorPatientId(int $doctorPatientId): void
    {
        $this->doctorPatientId = $doctorPatientId;
    }

    public function getDoctorId(): int
    {
        return $this->doctorId;
    }

    public function setDoctorId(int $doctorId): void
    {
        $this->doctorId = $doctorId;
    }

    public function getPatientId(): int
    {
        return $this->patientId;
    }

    public function setPatientId(int $patientId): void
    {
        $this->patientId = $patientId;
    }

    public function getExaminationDate(): string
    {
        return $this->examinationDate;
    }

    public function setExaminationDate(string $examinationDate): void
    {
        $this->examinationDate = $examinationDate;
    }

    public function toDto(): DoctorPatientDto
    {
        $dto = new DoctorPatientDto();
        $dto->doctorPatientId = (int) ($this->doctorPatientId ?? 0);
        $dto->doctorId = (int) ($this->doctorId ?? 0);
        $dto->patientId = (int) ($this->patientId ?? 0);
        $dto->examinationDate = $this->examinationDate ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "doctor_patient_id" => $this->doctorPatientId,
            "doctor_id" => $this->doctorId,
            "patient_id" => $this->patientId,
            "examination_date" => $this->examinationDate,
        ];
    }
}