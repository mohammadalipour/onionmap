<?php

namespace App\Core\Domain\Model\ValueObject\Invoice;

use App\Core\Domain\Validation\IsBlank\IsBlank;
use App\Core\Domain\Validation\IsNumeric\IsNumeric;

class Title
{
    private string $title;

    public function __construct(string $title)
    {
        IsBlank::execute($title);

        $this->title = $title;
    }

    public function title(): int
    {
        return $this->title;
    }


    public function toString(): string
    {
        return $this->title;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}