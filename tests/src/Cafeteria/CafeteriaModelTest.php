<?php

declare(strict_types=1);

namespace Hospital\Tests\Cafeteria;

use PHPUnit\Framework\TestCase;
use Hospital\Cafeteria\{ CafeteriaDto, CafeteriaModel };

class CafeteriaModelTest extends TestCase
{
    private array $input;
    private CafeteriaDto $dto;
    private CafeteriaModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "cafeteria_id" => 3163,
            "food_type" => "nature",
            "seating" => 9241,
        ];
        $this->dto = new CafeteriaDto($this->input);
        $this->model = new CafeteriaModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new CafeteriaModel(null);

        $this->assertInstanceOf(CafeteriaModel::class, $model);
    }

    public function testGetCafeteriaId(): void
    {
        $this->assertEquals($this->dto->cafeteriaId, $this->model->getCafeteriaId());
    }

    public function testSetCafeteriaId(): void
    {
        $expected = 6698;
        $model = $this->model;
        $model->setCafeteriaId($expected);

        $this->assertEquals($expected, $model->getCafeteriaId());
    }

    public function testGetFoodType(): void
    {
        $this->assertEquals($this->dto->foodType, $this->model->getFoodType());
    }

    public function testSetFoodType(): void
    {
        $expected = "bed";
        $model = $this->model;
        $model->setFoodType($expected);

        $this->assertEquals($expected, $model->getFoodType());
    }

    public function testGetSeating(): void
    {
        $this->assertEquals($this->dto->seating, $this->model->getSeating());
    }

    public function testSetSeating(): void
    {
        $expected = 8536;
        $model = $this->model;
        $model->setSeating($expected);

        $this->assertEquals($expected, $model->getSeating());
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