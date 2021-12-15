<?php

namespace App\Core\Domain\Validation\InArray;

use App\Core\Domain\Validation\IValidator;

class InArray implements IValidator,IInArray
{
    private static array $status;

    public static function execute($value): bool
    {
        if (!in_array($value,self::$status)){
            throw new \RuntimeException("The status does not exist");
        }

        return true;
    }

    public function setArray(array $status): static
    {
         self::$status = $status;

         return $this;
    }
}