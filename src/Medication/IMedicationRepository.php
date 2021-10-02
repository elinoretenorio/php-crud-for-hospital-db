<?php

declare(strict_types=1);

namespace Hospital\Medication;

interface IMedicationRepository
{
    public function insert(MedicationDto $dto): int;

    public function update(MedicationDto $dto): int;

    public function get(int $medicationId): ?MedicationDto;

    public function getAll(): array;

    public function delete(int $medicationId): int;
}