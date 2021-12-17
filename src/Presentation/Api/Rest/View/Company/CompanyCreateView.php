<?php

namespace App\Presentation\Api\Rest\View\Company;

use App\Infrastructure\Framework\Form\FormRegistry;
use App\Infrastructure\Transfer\ResultCollection;
use App\Presentation\Api\Rest\Model\Company\CreateCompanyModel;

final class CompanyCreateView
{
    private FormRegistry $formRegistry;

    public function __construct(FormRegistry $formRegistry)
    {
        $this->formRegistry = $formRegistry;
    }

    /**
     * @param CreateCompanyModel $companyModel
     * @return ResultCollection
     */
    public function generate(CreateCompanyModel $companyModel): ResultCollection
    {
        return new ResultCollection([$companyModel]);
    }
}