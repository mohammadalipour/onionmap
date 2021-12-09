<?php

namespace App\Core\Application\Company\UseCase;

interface ICreateCompanyPresenter
{
    public function present(CreateResponse $createResponse);
}