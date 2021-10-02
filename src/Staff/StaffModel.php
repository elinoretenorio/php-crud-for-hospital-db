<?php

declare(strict_types=1);

namespace Hospital\Staff;

use JsonSerializable;

class StaffModel implements JsonSerializable
{
    private int $staffId;
    private string $jobTitle;
    private int $workerId;

    public function __construct(StaffDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->staffId = $dto->staffId;
        $this->jobTitle = $dto->jobTitle;
        $this->workerId = $dto->workerId;
    }

    public function getStaffId(): int
    {
        return $this->staffId;
    }

    public function setStaffId(int $staffId): void
    {
        $this->staffId = $staffId;
    }

    public function getJobTitle(): string
    {
        return $this->jobTitle;
    }

    public function setJobTitle(string $jobTitle): void
    {
        $this->jobTitle = $jobTitle;
    }

    public function getWorkerId(): int
    {
        return $this->workerId;
    }

    public function setWorkerId(int $workerId): void
    {
        $this->workerId = $workerId;
    }

    public function toDto(): StaffDto
    {
        $dto = new StaffDto();
        $dto->staffId = (int) ($this->staffId ?? 0);
        $dto->jobTitle = $this->jobTitle ?? "";
        $dto->workerId = (int) ($this->workerId ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "staff_id" => $this->staffId,
            "job_title" => $this->jobTitle,
            "worker_id" => $this->workerId,
        ];
    }
}