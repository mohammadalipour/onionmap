<?php

namespace App\Core\Domain\Company\Model\ValueObject;

use App\Core\Domain\Validation\IsBlank\IsBlank;
use App\Core\Domain\Validation\MaxLength\MaxLength;

class Title
{
    private string $title;

    public function __construct(string $title)
    {
        IsBlank::execute($title);
        (new MaxLength())->setMaxLength(255)::execute($title);

        $this->title = $title;
    }

    public function title(): string
    {
        return $this->title;
    }
}