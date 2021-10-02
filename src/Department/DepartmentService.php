<?php

declare(strict_types=1);

namespace Hospital\Department;

class DepartmentService implements IDepartmentService
{
    private IDepartmentRepository $repository;

    public function __construct(IDepartmentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(DepartmentModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(DepartmentModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $departmentId): ?DepartmentModel
    {
        $dto = $this->repository->get($departmentId);
        if ($dto === null) {
            return null;
        }

        return new DepartmentModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var DepartmentDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new DepartmentModel($dto);
        }

        return $result;
    }

    public function delete(int $departmentId): int
    {
        return $this->repository->delete($departmentId);
    }

    public function createModel(array $row): ?DepartmentModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new DepartmentDto($row);

        return new DepartmentModel($dto);
    }
}