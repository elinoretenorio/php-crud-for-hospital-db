<?php

declare(strict_types=1);

namespace Hospital\Worker;

interface IWorkerService
{
    public function insert(WorkerModel $model): int;

    public function update(WorkerModel $model): int;

    public function get(int $workerId): ?WorkerModel;

    public function getAll(): array;

    public function delete(int $workerId): int;

    public function createModel(array $row): ?WorkerModel;
}