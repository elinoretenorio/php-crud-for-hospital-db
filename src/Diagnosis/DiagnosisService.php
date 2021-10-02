<?php

declare(strict_types=1);

namespace Hospital\Diagnosis;

class DiagnosisService implements IDiagnosisService
{
    private IDiagnosisRepository $repository;

    public function __construct(IDiagnosisRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(DiagnosisModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(DiagnosisModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $diagnosisId): ?DiagnosisModel
    {
        $dto = $this->repository->get($diagnosisId);
        if ($dto === null) {
            return null;
        }

        return new DiagnosisModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var DiagnosisDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new DiagnosisModel($dto);
        }

        return $result;
    }

    public function delete(int $diagnosisId): int
    {
        return $this->repository->delete($diagnosisId);
    }

    public function createModel(array $row): ?DiagnosisModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new DiagnosisDto($row);

        return new DiagnosisModel($dto);
    }
}