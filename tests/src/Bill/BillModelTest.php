<?php

declare(strict_types=1);

namespace Hospital\Tests\Bill;

use PHPUnit\Framework\TestCase;
use Hospital\Bill\{ BillDto, BillModel };

class BillModelTest extends TestCase
{
    private array $input;
    private BillDto $dto;
    private BillModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "bill_id" => 9893,
            "tests" => "art",
            "treatment" => "meeting",
            "time_admitted" => "2021-10-15",
            "prescription" => "might",
        ];
        $this->dto = new BillDto($this->input);
        $this->model = new BillModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new BillModel(null);

        $this->assertInstanceOf(BillModel::class, $model);
    }

    public function testGetBillId(): void
    {
        $this->assertEquals($this->dto->billId, $this->model->getBillId());
    }

    public function testSetBillId(): void
    {
        $expected = 5841;
        $model = $this->model;
        $model->setBillId($expected);

        $this->assertEquals($expected, $model->getBillId());
    }

    public function testGetTests(): void
    {
        $this->assertEquals($this->dto->tests, $this->model->getTests());
    }

    public function testSetTests(): void
    {
        $expected = "because";
        $model = $this->model;
        $model->setTests($expected);

        $this->assertEquals($expected, $model->getTests());
    }

    public function testGetTreatment(): void
    {
        $this->assertEquals($this->dto->treatment, $this->model->getTreatment());
    }

    public function testSetTreatment(): void
    {
        $expected = "and";
        $model = $this->model;
        $model->setTreatment($expected);

        $this->assertEquals($expected, $model->getTreatment());
    }

    public function testGetTimeAdmitted(): void
    {
        $this->assertEquals($this->dto->timeAdmitted, $this->model->getTimeAdmitted());
    }

    public function testSetTimeAdmitted(): void
    {
        $expected = "2021-10-11";
        $model = $this->model;
        $model->setTimeAdmitted($expected);

        $this->assertEquals($expected, $model->getTimeAdmitted());
    }

    public function testGetPrescription(): void
    {
        $this->assertEquals($this->dto->prescription, $this->model->getPrescription());
    }

    public function testSetPrescription(): void
    {
        $expected = "tree";
        $model = $this->model;
        $model->setPrescription($expected);

        $this->assertEquals($expected, $model->getPrescription());
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