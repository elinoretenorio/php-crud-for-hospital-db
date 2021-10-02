<?php

declare(strict_types=1);

namespace Hospital\Tests\CafeteriaStaff;

use PHPUnit\Framework\TestCase;
use Hospital\CafeteriaStaff\{ CafeteriaStaffDto, CafeteriaStaffModel, CafeteriaStaffController };

class CafeteriaStaffControllerTest extends TestCase
{
    private array $input;
    private CafeteriaStaffDto $dto;
    private CafeteriaStaffModel $model;
    private $service;
    private $request;
    private $stream;
    private CafeteriaStaffController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "cafetria_staff_id" => 64,
            "staff_id" => 851,
            "cafeteria_id" => "over",
            "position" => "record",
        ];
        $this->dto = new CafeteriaStaffDto($this->input);
        $this->model = new CafeteriaStaffModel($this->dto);
        $this->service = $this->createMock("Hospital\CafeteriaStaff\ICafeteriaStaffService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new CafeteriaStaffController(
            $this->service
        );

        $this->stream->method("getContents")
            ->willReturn("[]");

        $this->request->method("getBody")
            ->willReturn($this->stream);

        $this->request->method("getParsedBody")
            ->willReturn($this->input);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
        unset($this->service);
        unset($this->request);
        unset($this->stream);
        unset($this->controller);
    }

    public function testInsert_ReturnsResponse(): void
    {
        $id = 6647;
        $expected = ["result" => $id];
        $args = [];

        $this->service->expects($this->once())
            ->method("createModel")
            ->with($this->request->getParsedBody())
            ->willReturn($this->model);
        $this->service->expects($this->once())
            ->method("insert")
            ->with($this->model)
            ->willReturn($id);

        $actual = $this->controller->insert($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsErrorResponse(): void
    {
        $expected = ["result" => 0, "message" => "Invalid input"];
        $args = ["cafetria_staff_id" => 0];

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsResponse(): void
    {
        $id = 1877;
        $expected = ["result" => $id];
        $args = ["cafetria_staff_id" => 8720];

        $this->service->expects($this->once())
            ->method("createModel")
            ->with($this->request->getParsedBody())
            ->willReturn($this->model);
        $this->service->expects($this->once())
            ->method("update")
            ->with($this->model)
            ->willReturn($id);

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsErrorResponse(): void
    {
        $expected = ["result" => 0, "message" => "Invalid input"];
        $args = ["cafetria_staff_id" => 0];

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsResponse(): void
    {
        $expected = ["result" => $this->model->jsonSerialize()];
        $args = ["cafetria_staff_id" => 2233];

        $this->service->expects($this->once())
            ->method("get")
            ->with($args["cafetria_staff_id"])
            ->willReturn($this->model);

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGetAll_ReturnsResponse(): void
    {
        $expected = ["result" => [$this->model->jsonSerialize()]];
        $args = [];

        $this->service->expects($this->once())
            ->method("getAll")
            ->willReturn([$this->model]);

        $actual = $this->controller->getAll($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsErrorResponse(): void
    {
        $expected = ["result" => 0, "message" => "Invalid input"];
        $args = ["cafetria_staff_id" => 0];

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsResponse(): void
    {
        $id = 9302;
        $expected = ["result" => $id];
        $args = ["cafetria_staff_id" => 468];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["cafetria_staff_id"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}