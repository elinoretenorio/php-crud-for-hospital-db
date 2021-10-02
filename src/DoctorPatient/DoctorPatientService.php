<?php

declare(strict_types=1);

namespace Hospital\DoctorPatient;

class DoctorPatientService implements IDoctorPatientService
{
    private IDoctorPatientRepository $repository;

    public function __construct(IDoctorPatientRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(DoctorPatientModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(DoctorPatientModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $doctorPatientId): ?DoctorPatientModel
    {
        $dto = $this->repository->get($doctorPatientId);
        if ($dto === null) {
            return null;
        }

        return new DoctorPatientModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var DoctorPatientDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new DoctorPatientModel($dto);
        }

        return $result;
    }

    public function delete(int $doctorPatientId): int
    {
        return $this->repository->delete($doctorPatientId);
    }

    public function createModel(array $row): ?DoctorPatientModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new DoctorPatientDto($row);

        return new DoctorPatientModel($dto);
    }
}