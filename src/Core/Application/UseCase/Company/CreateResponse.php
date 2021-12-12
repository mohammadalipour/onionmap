<?php

namespace App\Core\Application\UseCase\Company;

final class CreateResponse
{
    public int $id;
    public string $title;
    public int $debtorLimit;
}