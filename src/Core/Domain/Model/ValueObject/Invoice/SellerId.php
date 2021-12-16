<?php

namespace App\Core\Domain\Model\ValueObject\Invoice;

use App\Core\Domain\Validation\IsBlank\IsBlank;
use App\Core\Domain\Validation\IsNumeric\IsNumeric;

class SellerId
{
    private int $sellerId;

    public function __construct(int $sellerId)
    {
        IsBlank::execute($sellerId);
        IsNumeric::execute($sellerId);


        $this->sellerId = $sellerId;
    }

    public function sellerId(): int
    {
        return $this->sellerId;
    }


    public function toString(): string
    {
        return $this->sellerId;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}