<?php

declare(strict_types=1);

namespace Hospital\Medication;

class MedicationService implements IMedicationService
{
    private IMedicationRepository $repository;

    public function __construct(IMedicationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(MedicationModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(MedicationModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $medicationId): ?MedicationModel
    {
        $dto = $this->repository->get($medicationId);
        if ($dto === null) {
            return null;
        }

        return new MedicationModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var MedicationDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new MedicationModel($dto);
        }

        return $result;
    }

    public function delete(int $medicationId): int
    {
        return $this->repository->delete($medicationId);
    }

    public function createModel(array $row): ?MedicationModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new MedicationDto($row);

        return new MedicationModel($dto);
    }
}