<?php

declare(strict_types=1);

namespace Hospital\Worker;

interface IWorkerRepository
{
    public function insert(WorkerDto $dto): int;

    public function update(WorkerDto $dto): int;

    public function get(int $workerId): ?WorkerDto;

    public function getAll(): array;

    public function delete(int $workerId): int;
}