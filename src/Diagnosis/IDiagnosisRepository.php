<?php

declare(strict_types=1);

namespace Hospital\Diagnosis;

interface IDiagnosisRepository
{
    public function insert(DiagnosisDto $dto): int;

    public function update(DiagnosisDto $dto): int;

    public function get(int $diagnosisId): ?DiagnosisDto;

    public function getAll(): array;

    public function delete(int $diagnosisId): int;
}