<?php

declare(strict_types=1);

namespace Hospital\Tests;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class TestsController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private ITestsService $service;

    public function __construct(ITestsService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var TestsModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $testId = (int) ($args["test_id"] ?? 0);
        if ($testId <= 0) {
            return new JsonResponse(["result" => $testId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var TestsModel $model */
        $model = $this->service->createModel($data);
        $model->setTestId($testId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $testId = (int) ($args["test_id"] ?? 0);
        if ($testId <= 0) {
            return new JsonResponse(["result" => $testId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var TestsModel $model */
        $model = $this->service->get($testId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var TestsModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $testId = (int) ($args["test_id"] ?? 0);
        if ($testId <= 0) {
            return new JsonResponse(["result" => $testId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($testId);

        return new JsonResponse(["result" => $result]);
    }
}