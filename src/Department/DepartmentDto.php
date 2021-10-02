<?php

declare(strict_types=1);

namespace Hospital\Department;

class DepartmentDto 
{
    public int $departmentId;
    public int $workers;
    public string $buildingLocation;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->departmentId = (int) ($row["department_id"] ?? 0);
        $this->workers = (int) ($row["workers"] ?? 0);
        $this->buildingLocation = $row["building_location"] ?? "";
    }
}