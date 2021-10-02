<?php

declare(strict_types=1);

namespace Hospital\Department;

use JsonSerializable;

class DepartmentModel implements JsonSerializable
{
    private int $departmentId;
    private int $workers;
    private string $buildingLocation;

    public function __construct(DepartmentDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->departmentId = $dto->departmentId;
        $this->workers = $dto->workers;
        $this->buildingLocation = $dto->buildingLocation;
    }

    public function getDepartmentId(): int
    {
        return $this->departmentId;
    }

    public function setDepartmentId(int $departmentId): void
    {
        $this->departmentId = $departmentId;
    }

    public function getWorkers(): int
    {
        return $this->workers;
    }

    public function setWorkers(int $workers): void
    {
        $this->workers = $workers;
    }

    public function getBuildingLocation(): string
    {
        return $this->buildingLocation;
    }

    public function setBuildingLocation(string $buildingLocation): void
    {
        $this->buildingLocation = $buildingLocation;
    }

    public function toDto(): DepartmentDto
    {
        $dto = new DepartmentDto();
        $dto->departmentId = (int) ($this->departmentId ?? 0);
        $dto->workers = (int) ($this->workers ?? 0);
        $dto->buildingLocation = $this->buildingLocation ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "department_id" => $this->departmentId,
            "workers" => $this->workers,
            "building_location" => $this->buildingLocation,
        ];
    }
}