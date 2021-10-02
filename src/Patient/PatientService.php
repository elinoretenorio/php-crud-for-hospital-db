<?php

declare(strict_types=1);

namespace Hospital\Patient;

class PatientService implements IPatientService
{
    private IPatientRepository $repository;

    public function __construct(IPatientRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(PatientModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(PatientModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $patientId): ?PatientModel
    {
        $dto = $this->repository->get($patientId);
        if ($dto === null) {
            return null;
        }

        return new PatientModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var PatientDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new PatientModel($dto);
        }

        return $result;
    }

    public function delete(int $patientId): int
    {
        return $this->repository->delete($patientId);
    }

    public function createModel(array $row): ?PatientModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new PatientDto($row);

        return new PatientModel($dto);
    }
}