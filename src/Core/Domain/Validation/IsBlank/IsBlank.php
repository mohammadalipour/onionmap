<?php

namespace App\Core\Domain\Validation\IsBlank;

use App\Core\Domain\Validation\IValidator;

class IsBlank implements IValidator
{
    public static function execute($value): bool
    {
        if (empty($value)){
            throw new \RuntimeException("The value dose not exist");
        }

        return true;
    }
}