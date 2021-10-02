<?php

declare(strict_types=1);

namespace Hospital\Worker;

class WorkerService implements IWorkerService
{
    private IWorkerRepository $repository;

    public function __construct(IWorkerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(WorkerModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(WorkerModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $workerId): ?WorkerModel
    {
        $dto = $this->repository->get($workerId);
        if ($dto === null) {
            return null;
        }

        return new WorkerModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var WorkerDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new WorkerModel($dto);
        }

        return $result;
    }

    public function delete(int $workerId): int
    {
        return $this->repository->delete($workerId);
    }

    public function createModel(array $row): ?WorkerModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new WorkerDto($row);

        return new WorkerModel($dto);
    }
}