<?php

declare(strict_types=1);

namespace Hospital\Patient;

interface IPatientRepository
{
    public function insert(PatientDto $dto): int;

    public function update(PatientDto $dto): int;

    public function get(int $patientId): ?PatientDto;

    public function getAll(): array;

    public function delete(int $patientId): int;
}