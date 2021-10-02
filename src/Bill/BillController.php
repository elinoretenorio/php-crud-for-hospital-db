<?php

declare(strict_types=1);

namespace Hospital\Bill;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class BillController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IBillService $service;

    public function __construct(IBillService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var BillModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $billId = (int) ($args["bill_id"] ?? 0);
        if ($billId <= 0) {
            return new JsonResponse(["result" => $billId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var BillModel $model */
        $model = $this->service->createModel($data);
        $model->setBillId($billId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $billId = (int) ($args["bill_id"] ?? 0);
        if ($billId <= 0) {
            return new JsonResponse(["result" => $billId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var BillModel $model */
        $model = $this->service->get($billId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var BillModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $billId = (int) ($args["bill_id"] ?? 0);
        if ($billId <= 0) {
            return new JsonResponse(["result" => $billId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($billId);

        return new JsonResponse(["result" => $result]);
    }
}