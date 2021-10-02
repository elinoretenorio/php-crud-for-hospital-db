<?php

declare(strict_types=1);

namespace Hospital\Doctor;

interface IDoctorRepository
{
    public function insert(DoctorDto $dto): int;

    public function update(DoctorDto $dto): int;

    public function get(int $doctorId): ?DoctorDto;

    public function getAll(): array;

    public function delete(int $doctorId): int;
}