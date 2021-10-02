<?php

declare(strict_types=1);

namespace Hospital\Cafeteria;

class CafeteriaDto 
{
    public int $cafeteriaId;
    public string $foodType;
    public int $seating;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->cafeteriaId = (int) ($row["cafeteria_id"] ?? 0);
        $this->foodType = $row["food_type"] ?? "";
        $this->seating = (int) ($row["seating"] ?? 0);
    }
}