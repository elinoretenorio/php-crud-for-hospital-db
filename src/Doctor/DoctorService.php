<?php

declare(strict_types=1);

namespace Hospital\Doctor;

class DoctorService implements IDoctorService
{
    private IDoctorRepository $repository;

    public function __construct(IDoctorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(DoctorModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(DoctorModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $doctorId): ?DoctorModel
    {
        $dto = $this->repository->get($doctorId);
        if ($dto === null) {
            return null;
        }

        return new DoctorModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var DoctorDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new DoctorModel($dto);
        }

        return $result;
    }

    public function delete(int $doctorId): int
    {
        return $this->repository->delete($doctorId);
    }

    public function createModel(array $row): ?DoctorModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new DoctorDto($row);

        return new DoctorModel($dto);
    }
}