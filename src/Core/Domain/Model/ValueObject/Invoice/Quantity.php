<?php

namespace App\Core\Domain\Model\ValueObject\Invoice;

use App\Core\Domain\Validation\IsBlank\IsBlank;
use App\Core\Domain\Validation\IsNumeric\IsNumeric;

class Quantity
{
    private int $quantity = 0;

    public function __construct(int $quantity)
    {
        IsBlank::execute($quantity);
        IsNumeric::execute($quantity);

        $this->quantity = $quantity;
    }

    public function quantity(): int
    {
        return $this->quantity;
    }
}