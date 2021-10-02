<?php

declare(strict_types=1);

namespace Hospital\CafeteriaStaff;

use JsonSerializable;

class CafeteriaStaffModel implements JsonSerializable
{
    private int $cafetriaStaffId;
    private int $staffId;
    private string $cafeteriaId;
    private string $position;

    public function __construct(CafeteriaStaffDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->cafetriaStaffId = $dto->cafetriaStaffId;
        $this->staffId = $dto->staffId;
        $this->cafeteriaId = $dto->cafeteriaId;
        $this->position = $dto->position;
    }

    public function getCafetriaStaffId(): int
    {
        return $this->cafetriaStaffId;
    }

    public function setCafetriaStaffId(int $cafetriaStaffId): void
    {
        $this->cafetriaStaffId = $cafetriaStaffId;
    }

    public function getStaffId(): int
    {
        return $this->staffId;
    }

    public function setStaffId(int $staffId): void
    {
        $this->staffId = $staffId;
    }

    public function getCafeteriaId(): string
    {
        return $this->cafeteriaId;
    }

    public function setCafeteriaId(string $cafeteriaId): void
    {
        $this->cafeteriaId = $cafeteriaId;
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function setPosition(string $position): void
    {
        $this->position = $position;
    }

    public function toDto(): CafeteriaStaffDto
    {
        $dto = new CafeteriaStaffDto();
        $dto->cafetriaStaffId = (int) ($this->cafetriaStaffId ?? 0);
        $dto->staffId = (int) ($this->staffId ?? 0);
        $dto->cafeteriaId = $this->cafeteriaId ?? "";
        $dto->position = $this->position ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "cafetria_staff_id" => $this->cafetriaStaffId,
            "staff_id" => $this->staffId,
            "cafeteria_id" => $this->cafeteriaId,
            "position" => $this->position,
        ];
    }
}