<?php

declare(strict_types=1);

namespace Hospital\Department;

interface IDepartmentRepository
{
    public function insert(DepartmentDto $dto): int;

    public function update(DepartmentDto $dto): int;

    public function get(int $departmentId): ?DepartmentDto;

    public function getAll(): array;

    public function delete(int $departmentId): int;
}