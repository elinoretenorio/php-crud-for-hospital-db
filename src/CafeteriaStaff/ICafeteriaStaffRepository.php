<?php

declare(strict_types=1);

namespace Hospital\CafeteriaStaff;

interface ICafeteriaStaffRepository
{
    public function insert(CafeteriaStaffDto $dto): int;

    public function update(CafeteriaStaffDto $dto): int;

    public function get(int $cafetriaStaffId): ?CafeteriaStaffDto;

    public function getAll(): array;

    public function delete(int $cafetriaStaffId): int;
}