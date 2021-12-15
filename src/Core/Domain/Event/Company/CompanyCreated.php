<?php

namespace App\Core\Domain\Event\Company;

use App\Core\Domain\Model\ValueObject\Company\CompanyId;

final class CompanyCreated
{
    private CompanyId $companyId;

    public function __construct(CompanyId $id)
    {
        $this->companyId = $id;
    }

    public function companyId(): CompanyId
    {
        return $this->companyId;
    }
}