<?php

namespace App\Core\Domain\Model\ValueObject\Invoice;

use App\Core\Domain\Validation\InArray\InArray;
use App\Core\Domain\Validation\IsBlank\IsBlank;

class Type
{
    const SERVICE_TYPE = 'service';
    const SALE_TYPE = 'sale';
    const TYPE = [
        self::SALE_TYPE,
        self::SERVICE_TYPE
    ];
    private string $type = self::SERVICE_TYPE;

    public function __construct(string $type)
    {
        IsBlank::execute($type);
        (new InArray())->setArray(self::TYPE)::execute($type);

        $this->type = $type;
    }

    public function type(): string
    {
        return $this->type;
    }


    public function toString(): string
    {
        return $this->type;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}