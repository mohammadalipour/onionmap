<?php

namespace App\Core\Domain\Model\ValueObject\Invoice;

use App\Core\Domain\Validation\InArray\InArray;
use App\Core\Domain\Validation\IsBlank\IsBlank;
use App\Core\Domain\Validation\IsNumeric\IsNumeric;

class Status
{
    const PENDING_STATUS = 'pending';
    const PAID_STATUS = 'paid';
    const STATUS = [
        self::PAID_STATUS,
        self::PENDING_STATUS
    ];
    private string $status = self::PENDING_STATUS;

    public function __construct(string $status = self::PENDING_STATUS)
    {
        IsBlank::execute($status);
        (new InArray())->setArray(self::STATUS)::execute($status);

        $this->status = $status;
    }

    public function status(): string
    {
        return $this->status;
    }


    public function toString(): string
    {
        return $this->status;
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function is(string $status): bool
    {
        return $this->status === $status;
    }
}