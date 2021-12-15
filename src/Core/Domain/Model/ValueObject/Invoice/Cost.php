<?php

namespace App\Core\Domain\Model\ValueObject\Invoice;

use App\Core\Domain\Validation\IsBlank\IsBlank;
use App\Core\Domain\Validation\IsNumeric\IsNumeric;

class Cost
{
    private int $cost = 0;

    public function __construct(int $cost)
    {
        IsBlank::execute($cost);
        IsNumeric::execute($cost);

        $this->cost = $cost;
    }

    public function cost(): int
    {
        return $this->cost;
    }
}