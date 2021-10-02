<?php

declare(strict_types=1);

namespace Hospital\MedicationPrescribed;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class MedicationPrescribedController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IMedicationPrescribedService $service;

    public function __construct(IMedicationPrescribedService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var MedicationPrescribedModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $medicationPrescribedId = (int) ($args["medication_prescribed_id"] ?? 0);
        if ($medicationPrescribedId <= 0) {
            return new JsonResponse(["result" => $medicationPrescribedId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var MedicationPrescribedModel $model */
        $model = $this->service->createModel($data);
        $model->setMedicationPrescribedId($medicationPrescribedId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $medicationPrescribedId = (int) ($args["medication_prescribed_id"] ?? 0);
        if ($medicationPrescribedId <= 0) {
            return new JsonResponse(["result" => $medicationPrescribedId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var MedicationPrescribedModel $model */
        $model = $this->service->get($medicationPrescribedId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var MedicationPrescribedModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $medicationPrescribedId = (int) ($args["medication_prescribed_id"] ?? 0);
        if ($medicationPrescribedId <= 0) {
            return new JsonResponse(["result" => $medicationPrescribedId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($medicationPrescribedId);

        return new JsonResponse(["result" => $result]);
    }
}