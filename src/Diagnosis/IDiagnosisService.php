<?php

declare(strict_types=1);

namespace Hospital\Diagnosis;

interface IDiagnosisService
{
    public function insert(DiagnosisModel $model): int;

    public function update(DiagnosisModel $model): int;

    public function get(int $diagnosisId): ?DiagnosisModel;

    public function getAll(): array;

    public function delete(int $diagnosisId): int;

    public function createModel(array $row): ?DiagnosisModel;
}