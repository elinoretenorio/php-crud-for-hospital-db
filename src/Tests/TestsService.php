<?php

declare(strict_types=1);

namespace Hospital\Tests;

class TestsService implements ITestsService
{
    private ITestsRepository $repository;

    public function __construct(ITestsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(TestsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(TestsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $testId): ?TestsModel
    {
        $dto = $this->repository->get($testId);
        if ($dto === null) {
            return null;
        }

        return new TestsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var TestsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new TestsModel($dto);
        }

        return $result;
    }

    public function delete(int $testId): int
    {
        return $this->repository->delete($testId);
    }

    public function createModel(array $row): ?TestsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new TestsDto($row);

        return new TestsModel($dto);
    }
}