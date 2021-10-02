<?php

declare(strict_types=1);

namespace Hospital\Tests;

interface ITestsRepository
{
    public function insert(TestsDto $dto): int;

    public function update(TestsDto $dto): int;

    public function get(int $testId): ?TestsDto;

    public function getAll(): array;

    public function delete(int $testId): int;
}