<?php

declare(strict_types=1);

namespace Hospital\Tests;

interface ITestsService
{
    public function insert(TestsModel $model): int;

    public function update(TestsModel $model): int;

    public function get(int $testId): ?TestsModel;

    public function getAll(): array;

    public function delete(int $testId): int;

    public function createModel(array $row): ?TestsModel;
}