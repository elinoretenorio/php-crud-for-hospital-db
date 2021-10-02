<?php

declare(strict_types=1);

namespace Hospital\MedicationPrescribed;

class MedicationPrescribedService implements IMedicationPrescribedService
{
    private IMedicationPrescribedRepository $repository;

    public function __construct(IMedicationPrescribedRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(MedicationPrescribedModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(MedicationPrescribedModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $medicationPrescribedId): ?MedicationPrescribedModel
    {
        $dto = $this->repository->get($medicationPrescribedId);
        if ($dto === null) {
            return null;
        }

        return new MedicationPrescribedModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var MedicationPrescribedDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new MedicationPrescribedModel($dto);
        }

        return $result;
    }

    public function delete(int $medicationPrescribedId): int
    {
        return $this->repository->delete($medicationPrescribedId);
    }

    public function createModel(array $row): ?MedicationPrescribedModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new MedicationPrescribedDto($row);

        return new MedicationPrescribedModel($dto);
    }
}