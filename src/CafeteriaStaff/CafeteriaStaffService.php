<?php

declare(strict_types=1);

namespace Hospital\CafeteriaStaff;

class CafeteriaStaffService implements ICafeteriaStaffService
{
    private ICafeteriaStaffRepository $repository;

    public function __construct(ICafeteriaStaffRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(CafeteriaStaffModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(CafeteriaStaffModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $cafetriaStaffId): ?CafeteriaStaffModel
    {
        $dto = $this->repository->get($cafetriaStaffId);
        if ($dto === null) {
            return null;
        }

        return new CafeteriaStaffModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var CafeteriaStaffDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new CafeteriaStaffModel($dto);
        }

        return $result;
    }

    public function delete(int $cafetriaStaffId): int
    {
        return $this->repository->delete($cafetriaStaffId);
    }

    public function createModel(array $row): ?CafeteriaStaffModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new CafeteriaStaffDto($row);

        return new CafeteriaStaffModel($dto);
    }
}