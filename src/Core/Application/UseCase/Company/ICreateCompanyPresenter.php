<?php

namespace App\Core\Application\UseCase\Company;

interface ICreateCompanyPresenter
{
    public function present(CreateResponse $createResponse);
}