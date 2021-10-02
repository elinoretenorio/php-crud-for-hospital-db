<?php

declare(strict_types=1);

namespace Hospital\Tests\Medication;

use PHPUnit\Framework\TestCase;
use Hospital\Medication\{ MedicationDto, MedicationModel };

class MedicationModelTest extends TestCase
{
    private array $input;
    private MedicationDto $dto;
    private MedicationModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "medication_id" => 501,
            "doses" => 1260,
            "expiration_date" => "2021-10-09",
        ];
        $this->dto = new MedicationDto($this->input);
        $this->model = new MedicationModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new MedicationModel(null);

        $this->assertInstanceOf(MedicationModel::class, $model);
    }

    public function testGetMedicationId(): void
    {
        $this->assertEquals($this->dto->medicationId, $this->model->getMedicationId());
    }

    public function testSetMedicationId(): void
    {
        $expected = 755;
        $model = $this->model;
        $model->setMedicationId($expected);

        $this->assertEquals($expected, $model->getMedicationId());
    }

    public function testGetDoses(): void
    {
        $this->assertEquals($this->dto->doses, $this->model->getDoses());
    }

    public function testSetDoses(): void
    {
        $expected = 8219;
        $model = $this->model;
        $model->setDoses($expected);

        $this->assertEquals($expected, $model->getDoses());
    }

    public function testGetExpirationDate(): void
    {
        $this->assertEquals($this->dto->expirationDate, $this->model->getExpirationDate());
    }

    public function testSetExpirationDate(): void
    {
        $expected = "2021-10-07";
        $model = $this->model;
        $model->setExpirationDate($expected);

        $this->assertEquals($expected, $model->getExpirationDate());
    }

    public function testToDto(): void
    {
        $this->assertEquals($this->dto, $this->model->toDto());
    }

    public function testJsonSerialize(): void
    {
        $this->assertEquals($this->input, $this->model->jsonSerialize());
    }
}