<?php

declare(strict_types=1);

namespace Hospital\DoctorPatient;

interface IDoctorPatientRepository
{
    public function insert(DoctorPatientDto $dto): int;

    public function update(DoctorPatientDto $dto): int;

    public function get(int $doctorPatientId): ?DoctorPatientDto;

    public function getAll(): array;

    public function delete(int $doctorPatientId): int;
}