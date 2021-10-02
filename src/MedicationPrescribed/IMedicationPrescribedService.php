<?php

declare(strict_types=1);

namespace Hospital\MedicationPrescribed;

interface IMedicationPrescribedService
{
    public function insert(MedicationPrescribedModel $model): int;

    public function update(MedicationPrescribedModel $model): int;

    public function get(int $medicationPrescribedId): ?MedicationPrescribedModel;

    public function getAll(): array;

    public function delete(int $medicationPrescribedId): int;

    public function createModel(array $row): ?MedicationPrescribedModel;
}