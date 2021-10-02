<?php

declare(strict_types=1);

namespace Hospital\Bill;

interface IBillRepository
{
    public function insert(BillDto $dto): int;

    public function update(BillDto $dto): int;

    public function get(int $billId): ?BillDto;

    public function getAll(): array;

    public function delete(int $billId): int;
}