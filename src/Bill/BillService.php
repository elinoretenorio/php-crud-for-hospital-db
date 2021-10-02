<?php

declare(strict_types=1);

namespace Hospital\Bill;

class BillService implements IBillService
{
    private IBillRepository $repository;

    public function __construct(IBillRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(BillModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(BillModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $billId): ?BillModel
    {
        $dto = $this->repository->get($billId);
        if ($dto === null) {
            return null;
        }

        return new BillModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var BillDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new BillModel($dto);
        }

        return $result;
    }

    public function delete(int $billId): int
    {
        return $this->repository->delete($billId);
    }

    public function createModel(array $row): ?BillModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new BillDto($row);

        return new BillModel($dto);
    }
}