<?php

declare(strict_types=1);

namespace Hospital\Patient;

interface IPatientService
{
    public function insert(PatientModel $model): int;

    public function update(PatientModel $model): int;

    public function get(int $patientId): ?PatientModel;

    public function getAll(): array;

    public function delete(int $patientId): int;

    public function createModel(array $row): ?PatientModel;
}