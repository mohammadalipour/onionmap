<?php

namespace App\Core\Application\UseCase\Company;

class CreateCompanyRequest
{
    public string $title;
    public int $debtorLimit;
}