<?php

namespace App\Core\Domain\Company\Repository;

use App\Core\Domain\Company\Model\Entity\Company;
use App\Core\Domain\Company\Model\ValueObject\CompanyId;

interface ICompanyRepository
{
    public function add(Company $company): void;

    public function get(CompanyId $companyId): Company;
}