<?php

declare(strict_types=1);

namespace Hospital\Tests;

use JsonSerializable;

class TestsModel implements JsonSerializable
{
    private int $testId;
    private int $result;
    private string $illness;
    private int $doctorId;
    private int $patientId;

    public function __construct(TestsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->testId = $dto->testId;
        $this->result = $dto->result;
        $this->illness = $dto->illness;
        $this->doctorId = $dto->doctorId;
        $this->patientId = $dto->patientId;
    }

    public function getTestId(): int
    {
        return $this->testId;
    }

    public function setTestId(int $testId): void
    {
        $this->testId = $testId;
    }

    public function getResult(): int
    {
        return $this->result;
    }

    public function setResult(int $result): void
    {
        $this->result = $result;
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

    public function toDto(): TestsDto
    {
        $dto = new TestsDto();
        $dto->testId = (int) ($this->testId ?? 0);
        $dto->result = (int) ($this->result ?? 0);
        $dto->illness = $this->illness ?? "";
        $dto->doctorId = (int) ($this->doctorId ?? 0);
        $dto->patientId = (int) ($this->patientId ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "test_id" => $this->testId,
            "result" => $this->result,
            "illness" => $this->illness,
            "doctor_id" => $this->doctorId,
            "patient_id" => $this->patientId,
        ];
    }
}