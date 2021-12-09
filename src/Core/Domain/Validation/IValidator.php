<?php

namespace App\Core\Domain\Validation;

interface IValidator
{
    public static function execute($value):bool;
}