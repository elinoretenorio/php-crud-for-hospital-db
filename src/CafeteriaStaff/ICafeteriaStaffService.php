<?php

declare(strict_types=1);

namespace Hospital\CafeteriaStaff;

interface ICafeteriaStaffService
{
    public function insert(CafeteriaStaffModel $model): int;

    public function update(CafeteriaStaffModel $model): int;

    public function get(int $cafetriaStaffId): ?CafeteriaStaffModel;

    public function getAll(): array;

    public function delete(int $cafetriaStaffId): int;

    public function createModel(array $row): ?CafeteriaStaffModel;
}