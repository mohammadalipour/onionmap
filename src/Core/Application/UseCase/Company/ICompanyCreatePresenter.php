<?php

namespace App\Core\Application\UseCase\Company;

interface ICompanyCreatePresenter
{
    public function present(CreateCompanyResponse $createResponse);
}