<?php

declare(strict_types=1);

namespace Hospital\Staff;

class StaffDto 
{
    public int $staffId;
    public string $jobTitle;
    public int $workerId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->staffId = (int) ($row["staff_id"] ?? 0);
        $this->jobTitle = $row["job_title"] ?? "";
        $this->workerId = (int) ($row["worker_id"] ?? 0);
    }
}