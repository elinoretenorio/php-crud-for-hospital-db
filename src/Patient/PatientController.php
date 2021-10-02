<?php

declare(strict_types=1);

namespace Hospital\Patient;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class PatientController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IPatientService $service;

    public function __construct(IPatientService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var PatientModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $patientId = (int) ($args["patient_id"] ?? 0);
        if ($patientId <= 0) {
            return new JsonResponse(["result" => $patientId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var PatientModel $model */
        $model = $this->service->createModel($data);
        $model->setPatientId($patientId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $patientId = (int) ($args["patient_id"] ?? 0);
        if ($patientId <= 0) {
            return new JsonResponse(["result" => $patientId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var PatientModel $model */
        $model = $this->service->get($patientId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var PatientModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $patientId = (int) ($args["patient_id"] ?? 0);
        if ($patientId <= 0) {
            return new JsonResponse(["result" => $patientId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($patientId);

        return new JsonResponse(["result" => $result]);
    }
}