<?php

declare(strict_types=1);

namespace Hospital\Doctor;

use JsonSerializable;

class DoctorModel implements JsonSerializable
{
    private int $doctorId;
    private string $field;
    private string $degree;
    private string $departmentId;
    private int $workerId;

    public function __construct(DoctorDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->doctorId = $dto->doctorId;
        $this->field = $dto->field;
        $this->degree = $dto->degree;
        $this->departmentId = $dto->departmentId;
        $this->workerId = $dto->workerId;
    }

    public function getDoctorId(): int
    {
        return $this->doctorId;
    }

    public function setDoctorId(int $doctorId): void
    {
        $this->doctorId = $doctorId;
    }

    public function getField(): string
    {
        return $this->field;
    }

    public function setField(string $field): void
    {
        $this->field = $field;
    }

    public function getDegree(): string
    {
        return $this->degree;
    }

    public function setDegree(string $degree): void
    {
        $this->degree = $degree;
    }

    public function getDepartmentId(): string
    {
        return $this->departmentId;
    }

    public function setDepartmentId(string $departmentId): void
    {
        $this->departmentId = $departmentId;
    }

    public function getWorkerId(): int
    {
        return $this->workerId;
    }

    public function setWorkerId(int $workerId): void
    {
        $this->workerId = $workerId;
    }

    public function toDto(): DoctorDto
    {
        $dto = new DoctorDto();
        $dto->doctorId = (int) ($this->doctorId ?? 0);
        $dto->field = $this->field ?? "";
        $dto->degree = $this->degree ?? "";
        $dto->departmentId = $this->departmentId ?? "";
        $dto->workerId = (int) ($this->workerId ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "doctor_id" => $this->doctorId,
            "field" => $this->field,
            "degree" => $this->degree,
            "department_id" => $this->departmentId,
            "worker_id" => $this->workerId,
        ];
    }
}