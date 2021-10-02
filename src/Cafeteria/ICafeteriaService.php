<?php

declare(strict_types=1);

namespace Hospital\Cafeteria;

interface ICafeteriaService
{
    public function insert(CafeteriaModel $model): int;

    public function update(CafeteriaModel $model): int;

    public function get(int $cafeteriaId): ?CafeteriaModel;

    public function getAll(): array;

    public function delete(int $cafeteriaId): int;

    public function createModel(array $row): ?CafeteriaModel;
}