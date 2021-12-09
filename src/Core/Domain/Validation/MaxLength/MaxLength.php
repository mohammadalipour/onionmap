<?php

namespace App\Core\Domain\Validation\MaxLength;

use App\Core\Domain\Validation\IValidator;

class MaxLength implements IValidator,IMaxLength
{
    private static int $maxLength = 0;

    public static function execute($value): bool
    {
        if (strlen($value)>self::$maxLength){
            throw new \RuntimeException("The value is greater than max length");
        }

        return true;
    }

    public function setMaxLength(int $value): static
    {
        self::$maxLength = $value;

        return $this;
    }
}