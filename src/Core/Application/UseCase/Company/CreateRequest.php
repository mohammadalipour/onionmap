<?php

namespace App\Core\Application\UseCase\Company;

class CreateRequest
{
    public string $title;
    public int $debtorLimit;
}