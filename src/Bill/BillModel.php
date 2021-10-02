<?php

declare(strict_types=1);

namespace Hospital\Bill;

use JsonSerializable;

class BillModel implements JsonSerializable
{
    private int $billId;
    private string $tests;
    private string $treatment;
    private string $timeAdmitted;
    private string $prescription;

    public function __construct(BillDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->billId = $dto->billId;
        $this->tests = $dto->tests;
        $this->treatment = $dto->treatment;
        $this->timeAdmitted = $dto->timeAdmitted;
        $this->prescription = $dto->prescription;
    }

    public function getBillId(): int
    {
        return $this->billId;
    }

    public function setBillId(int $billId): void
    {
        $this->billId = $billId;
    }

    public function getTests(): string
    {
        return $this->tests;
    }

    public function setTests(string $tests): void
    {
        $this->tests = $tests;
    }

    public function getTreatment(): string
    {
        return $this->treatment;
    }

    public function setTreatment(string $treatment): void
    {
        $this->treatment = $treatment;
    }

    public function getTimeAdmitted(): string
    {
        return $this->timeAdmitted;
    }

    public function setTimeAdmitted(string $timeAdmitted): void
    {
        $this->timeAdmitted = $timeAdmitted;
    }

    public function getPrescription(): string
    {
        return $this->prescription;
    }

    public function setPrescription(string $prescription): void
    {
        $this->prescription = $prescription;
    }

    public function toDto(): BillDto
    {
        $dto = new BillDto();
        $dto->billId = (int) ($this->billId ?? 0);
        $dto->tests = $this->tests ?? "";
        $dto->treatment = $this->treatment ?? "";
        $dto->timeAdmitted = $this->timeAdmitted ?? "";
        $dto->prescription = $this->prescription ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "bill_id" => $this->billId,
            "tests" => $this->tests,
            "treatment" => $this->treatment,
            "time_admitted" => $this->timeAdmitted,
            "prescription" => $this->prescription,
        ];
    }
}