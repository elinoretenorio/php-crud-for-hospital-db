<?php

declare(strict_types=1);

namespace Hospital\CafeteriaStaff;

class CafeteriaStaffDto 
{
    public int $cafetriaStaffId;
    public int $staffId;
    public string $cafeteriaId;
    public string $position;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->cafetriaStaffId = (int) ($row["cafetria_staff_id"] ?? 0);
        $this->staffId = (int) ($row["staff_id"] ?? 0);
        $this->cafeteriaId = $row["cafeteria_id"] ?? "";
        $this->position = $row["position"] ?? "";
    }
}