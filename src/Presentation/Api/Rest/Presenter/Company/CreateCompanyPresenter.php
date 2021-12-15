<?php

namespace App\Presentation\Api\Rest\Presenter\Company;

use App\Core\Application\UseCase\Company\CreateCompanyResponse;
use App\Core\Application\UseCase\Company\ICreateCompanyPresenter;
use App\Presentation\Api\Rest\Model\Company\CreateCompanyModel;

class CreateCompanyPresenter implements ICreateCompanyPresenter
{
    public function present(CreateCompanyResponse $createResponse): CreateCompanyModel
    {
        $model = new CreateCompanyModel();
        $model->title = $createResponse->title;
        $model->debtorLimit = $createResponse->debtorLimit;

        return $model;
    }
}