<?php

namespace App\Core\Application\UseCase\Company;

final class CreateCompanyResponse
{
    public int $id;
    public string $title;
    public int $debtorLimit;
}