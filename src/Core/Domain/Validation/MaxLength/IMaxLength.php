<?php

namespace App\Core\Domain\Validation\MaxLength;

interface IMaxLength
{
    public function setMaxLength(int $value);
}