<?php

declare(strict_types=1);

namespace Hospital\MedicationPrescribed;

use JsonSerializable;

class MedicationPrescribedModel implements JsonSerializable
{
    private int $medicationPrescribedId;
    private int $prescriptionId;
    private string $medicationId;
    private int $patientId;

    public function __construct(MedicationPrescribedDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->medicationPrescribedId = $dto->medicationPrescribedId;
        $this->prescriptionId = $dto->prescriptionId;
        $this->medicationId = $dto->medicationId;
        $this->patientId = $dto->patientId;
    }

    public function getMedicationPrescribedId(): int
    {
        return $this->medicationPrescribedId;
    }

    public function setMedicationPrescribedId(int $medicationPrescribedId): void
    {
        $this->medicationPrescribedId = $medicationPrescribedId;
    }

    public function getPrescriptionId(): int
    {
        return $this->prescriptionId;
    }

    public function setPrescriptionId(int $prescriptionId): void
    {
        $this->prescriptionId = $prescriptionId;
    }

    public function getMedicationId(): string
    {
        return $this->medicationId;
    }

    public function setMedicationId(string $medicationId): void
    {
        $this->medicationId = $medicationId;
    }

    public function getPatientId(): int
    {
        return $this->patientId;
    }

    public function setPatientId(int $patientId): void
    {
        $this->patientId = $patientId;
    }

    public function toDto(): MedicationPrescribedDto
    {
        $dto = new MedicationPrescribedDto();
        $dto->medicationPrescribedId = (int) ($this->medicationPrescribedId ?? 0);
        $dto->prescriptionId = (int) ($this->prescriptionId ?? 0);
        $dto->medicationId = $this->medicationId ?? "";
        $dto->patientId = (int) ($this->patientId ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "medication_prescribed_id" => $this->medicationPrescribedId,
            "prescription_id" => $this->prescriptionId,
            "medication_id" => $this->medicationId,
            "patient_id" => $this->patientId,
        ];
    }
}