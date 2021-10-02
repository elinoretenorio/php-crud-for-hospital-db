<?php

declare(strict_types=1);

namespace Hospital\Diagnosis;

use JsonSerializable;

class DiagnosisModel implements JsonSerializable
{
    private int $diagnosisId;
    private string $illness;
    private int $doctorId;
    private int $patientId;

    public function __construct(DiagnosisDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->diagnosisId = $dto->diagnosisId;
        $this->illness = $dto->illness;
        $this->doctorId = $dto->doctorId;
        $this->patientId = $dto->patientId;
    }

    public function getDiagnosisId(): int
    {
        return $this->diagnosisId;
    }

    public function setDiagnosisId(int $diagnosisId): void
    {
        $this->diagnosisId = $diagnosisId;
    }

    public function getIllness(): string
    {
        return $this->illness;
    }

    public function setIllness(string $illness): void
    {
        $this->illness = $illness;
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

    public function toDto(): DiagnosisDto
    {
        $dto = new DiagnosisDto();
        $dto->diagnosisId = (int) ($this->diagnosisId ?? 0);
        $dto->illness = $this->illness ?? "";
        $dto->doctorId = (int) ($this->doctorId ?? 0);
        $dto->patientId = (int) ($this->patientId ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "diagnosis_id" => $this->diagnosisId,
            "illness" => $this->illness,
            "doctor_id" => $this->doctorId,
            "patient_id" => $this->patientId,
        ];
    }
}