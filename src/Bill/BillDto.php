<?php

declare(strict_types=1);

namespace Hospital\Bill;

class BillDto 
{
    public int $billId;
    public string $tests;
    public string $treatment;
    public string $timeAdmitted;
    public string $prescription;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->billId = (int) ($row["bill_id"] ?? 0);
        $this->tests = $row["tests"] ?? "";
        $this->treatment = $row["treatment"] ?? "";
        $this->timeAdmitted = $row["time_admitted"] ?? "";
        $this->prescription = $row["prescription"] ?? "";
    }
}