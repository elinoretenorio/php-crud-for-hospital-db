<?php

declare(strict_types=1);

namespace Hospital\Worker;

use JsonSerializable;

class WorkerModel implements JsonSerializable
{
    private int $workerId;
    private string $firstName;
    private string $lastName;
    private string $gender;
    private string $telephone;
    private float $salary;

    public function __construct(WorkerDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->workerId = $dto->workerId;
        $this->firstName = $dto->firstName;
        $this->lastName = $dto->lastName;
        $this->gender = $dto->gender;
        $this->telephone = $dto->telephone;
        $this->salary = $dto->salary;
    }

    public function getWorkerId(): int
    {
        return $this->workerId;
    }

    public function setWorkerId(int $workerId): void
    {
        $this->workerId = $workerId;
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

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): void
    {
        $this->telephone = $telephone;
    }

    public function getSalary(): float
    {
        return $this->salary;
    }

    public function setSalary(float $salary): void
    {
        $this->salary = $salary;
    }

    public function toDto(): WorkerDto
    {
        $dto = new WorkerDto();
        $dto->workerId = (int) ($this->workerId ?? 0);
        $dto->firstName = $this->firstName ?? "";
        $dto->lastName = $this->lastName ?? "";
        $dto->gender = $this->gender ?? "";
        $dto->telephone = $this->telephone ?? "";
        $dto->salary = (float) ($this->salary ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "worker_id" => $this->workerId,
            "first_name" => $this->firstName,
            "last_name" => $this->lastName,
            "gender" => $this->gender,
            "telephone" => $this->telephone,
            "salary" => $this->salary,
        ];
    }
}