<?php

namespace App\Core\Domain\Validation\IsNumeric;

use App\Core\Domain\Validation\IValidator;

class IsNumeric implements IValidator
{

    public static function execute($value): bool
    {
        if (!is_numeric($value)){
            throw new \RuntimeException("The value dose not numeric");
        }

        return true;
    }
}