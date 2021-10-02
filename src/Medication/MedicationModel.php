<?php

declare(strict_types=1);

namespace Hospital\Medication;

use JsonSerializable;

class MedicationModel implements JsonSerializable
{
    private int $medicationId;
    private int $doses;
    private string $expirationDate;

    public function __construct(MedicationDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->medicationId = $dto->medicationId;
        $this->doses = $dto->doses;
        $this->expirationDate = $dto->expirationDate;
    }

    public function getMedicationId(): int
    {
        return $this->medicationId;
    }

    public function setMedicationId(int $medicationId): void
    {
        $this->medicationId = $medicationId;
    }

    public function getDoses(): int
    {
        return $this->doses;
    }

    public function setDoses(int $doses): void
    {
        $this->doses = $doses;
    }

    public function getExpirationDate(): string
    {
        return $this->expirationDate;
    }

    public function setExpirationDate(string $expirationDate): void
    {
        $this->expirationDate = $expirationDate;
    }

    public function toDto(): MedicationDto
    {
        $dto = new MedicationDto();
        $dto->medicationId = (int) ($this->medicationId ?? 0);
        $dto->doses = (int) ($this->doses ?? 0);
        $dto->expirationDate = $this->expirationDate ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "medication_id" => $this->medicationId,
            "doses" => $this->doses,
            "expiration_date" => $this->expirationDate,
        ];
    }
}