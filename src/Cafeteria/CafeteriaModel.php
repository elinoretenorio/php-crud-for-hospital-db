<?php

declare(strict_types=1);

namespace Hospital\Cafeteria;

use JsonSerializable;

class CafeteriaModel implements JsonSerializable
{
    private int $cafeteriaId;
    private string $foodType;
    private int $seating;

    public function __construct(CafeteriaDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->cafeteriaId = $dto->cafeteriaId;
        $this->foodType = $dto->foodType;
        $this->seating = $dto->seating;
    }

    public function getCafeteriaId(): int
    {
        return $this->cafeteriaId;
    }

    public function setCafeteriaId(int $cafeteriaId): void
    {
        $this->cafeteriaId = $cafeteriaId;
    }

    public function getFoodType(): string
    {
        return $this->foodType;
    }

    public function setFoodType(string $foodType): void
    {
        $this->foodType = $foodType;
    }

    public function getSeating(): int
    {
        return $this->seating;
    }

    public function setSeating(int $seating): void
    {
        $this->seating = $seating;
    }

    public function toDto(): CafeteriaDto
    {
        $dto = new CafeteriaDto();
        $dto->cafeteriaId = (int) ($this->cafeteriaId ?? 0);
        $dto->foodType = $this->foodType ?? "";
        $dto->seating = (int) ($this->seating ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "cafeteria_id" => $this->cafeteriaId,
            "food_type" => $this->foodType,
            "seating" => $this->seating,
        ];
    }
}