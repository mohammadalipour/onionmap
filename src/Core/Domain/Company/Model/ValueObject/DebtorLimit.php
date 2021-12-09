<?php

namespace App\Core\Domain\Company\Model\ValueObject;


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
}