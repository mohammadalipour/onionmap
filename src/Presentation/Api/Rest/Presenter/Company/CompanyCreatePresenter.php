<?php

namespace App\Presentation\Api\Rest\Presenter\Company;

use App\Core\Application\UseCase\Company\CreateCompanyResponse;
use App\Core\Application\UseCase\Company\ICompanyCreatePresenter;
use App\Presentation\Api\Rest\Model\Company\CreateCompanyModel;

class CompanyCreatePresenter implements ICompanyCreatePresenter
{
    public function present(CreateCompanyResponse $createResponse): CreateCompanyModel
    {
        $model = new CreateCompanyModel();
        $model->title = $createResponse->title;
        $model->debtorLimit = $createResponse->debtorLimit;

        return $model;
    }
}