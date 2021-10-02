<?php

declare(strict_types=1);

namespace Hospital\DoctorPatient;

interface IDoctorPatientService
{
    public function insert(DoctorPatientModel $model): int;

    public function update(DoctorPatientModel $model): int;

    public function get(int $doctorPatientId): ?DoctorPatientModel;

    public function getAll(): array;

    public function delete(int $doctorPatientId): int;

    public function createModel(array $row): ?DoctorPatientModel;
}