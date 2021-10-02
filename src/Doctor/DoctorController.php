<?php

declare(strict_types=1);

namespace Hospital\Doctor;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class DoctorController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IDoctorService $service;

    public function __construct(IDoctorService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var DoctorModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $doctorId = (int) ($args["doctor_id"] ?? 0);
        if ($doctorId <= 0) {
            return new JsonResponse(["result" => $doctorId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var DoctorModel $model */
        $model = $this->service->createModel($data);
        $model->setDoctorId($doctorId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $doctorId = (int) ($args["doctor_id"] ?? 0);
        if ($doctorId <= 0) {
            return new JsonResponse(["result" => $doctorId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var DoctorModel $model */
        $model = $this->service->get($doctorId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var DoctorModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $doctorId = (int) ($args["doctor_id"] ?? 0);
        if ($doctorId <= 0) {
            return new JsonResponse(["result" => $doctorId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($doctorId);

        return new JsonResponse(["result" => $result]);
    }
}