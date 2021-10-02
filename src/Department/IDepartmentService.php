<?php

declare(strict_types=1);

namespace Hospital\Department;

interface IDepartmentService
{
    public function insert(DepartmentModel $model): int;

    public function update(DepartmentModel $model): int;

    public function get(int $departmentId): ?DepartmentModel;

    public function getAll(): array;

    public function delete(int $departmentId): int;

    public function createModel(array $row): ?DepartmentModel;
}