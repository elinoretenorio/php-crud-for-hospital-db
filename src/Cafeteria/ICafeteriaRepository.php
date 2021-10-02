<?php

declare(strict_types=1);

namespace Hospital\Cafeteria;

interface ICafeteriaRepository
{
    public function insert(CafeteriaDto $dto): int;

    public function update(CafeteriaDto $dto): int;

    public function get(int $cafeteriaId): ?CafeteriaDto;

    public function getAll(): array;

    public function delete(int $cafeteriaId): int;
}