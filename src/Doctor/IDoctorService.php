<?php

declare(strict_types=1);

namespace Hospital\Doctor;

interface IDoctorService
{
    public function insert(DoctorModel $model): int;

    public function update(DoctorModel $model): int;

    public function get(int $doctorId): ?DoctorModel;

    public function getAll(): array;

    public function delete(int $doctorId): int;

    public function createModel(array $row): ?DoctorModel;
}