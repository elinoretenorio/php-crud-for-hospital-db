<?php

declare(strict_types=1);

namespace Hospital\Cafeteria;

class CafeteriaService implements ICafeteriaService
{
    private ICafeteriaRepository $repository;

    public function __construct(ICafeteriaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(CafeteriaModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(CafeteriaModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $cafeteriaId): ?CafeteriaModel
    {
        $dto = $this->repository->get($cafeteriaId);
        if ($dto === null) {
            return null;
        }

        return new CafeteriaModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var CafeteriaDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new CafeteriaModel($dto);
        }

        return $result;
    }

    public function delete(int $cafeteriaId): int
    {
        return $this->repository->delete($cafeteriaId);
    }

    public function createModel(array $row): ?CafeteriaModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new CafeteriaDto($row);

        return new CafeteriaModel($dto);
    }
}