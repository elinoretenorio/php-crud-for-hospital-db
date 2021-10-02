<?php

declare(strict_types=1);

namespace Hospital\Medication;

interface IMedicationService
{
    public function insert(MedicationModel $model): int;

    public function update(MedicationModel $model): int;

    public function get(int $medicationId): ?MedicationModel;

    public function getAll(): array;

    public function delete(int $medicationId): int;

    public function createModel(array $row): ?MedicationModel;
}