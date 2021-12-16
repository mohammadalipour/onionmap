<?php

namespace App\Core\Domain\Model\ValueObject\Company;


use App\Core\Domain\Validation\IsBlank\IsBlank;
use App\Core\Domain\Validation\IsNumeric\IsNumeric;

class DebtorLimit
{
    private int $debtorLimit = 0;

    public function __construct(int $debtorLimit)
    {
        IsBlank::execute($debtorLimit);
        IsNumeric::execute($debtorLimit);

        $this->debtorLimit = $debtorLimit;
    }

    public function debtorLimit(): int
    {
        return $this->debtorLimit;
    }


    public function toString(): string
    {
        return $this->debtorLimit;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}