<?php

declare(strict_types=1);

namespace Hospital\Bill;

interface IBillService
{
    public function insert(BillModel $model): int;

    public function update(BillModel $model): int;

    public function get(int $billId): ?BillModel;

    public function getAll(): array;

    public function delete(int $billId): int;

    public function createModel(array $row): ?BillModel;
}