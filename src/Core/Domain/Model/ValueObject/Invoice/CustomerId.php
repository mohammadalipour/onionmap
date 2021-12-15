<?php

namespace App\Core\Domain\Model\ValueObject\Invoice;

use App\Core\Domain\Validation\IsBlank\IsBlank;
use App\Core\Domain\Validation\IsNumeric\IsNumeric;

class CustomerId
{
    private int $customerId;

    public function __construct(int $customerId)
    {
        IsBlank::execute($customerId);
        IsNumeric::execute($customerId);

        $this->customerId = $customerId;
    }

    public function customerId(): int
    {
        return $this->customerId;
    }
}