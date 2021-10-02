<?php

declare(strict_types=1);

namespace Hospital\MedicationPrescribed;

interface IMedicationPrescribedRepository
{
    public function insert(MedicationPrescribedDto $dto): int;

    public function update(MedicationPrescribedDto $dto): int;

    public function get(int $medicationPrescribedId): ?MedicationPrescribedDto;

    public function getAll(): array;

    public function delete(int $medicationPrescribedId): int;
}