<?php

namespace App\Core\Domain\Repository;

use App\Core\Domain\Model\Entity\Company;
use App\Core\Domain\Model\ValueObject\Company\CompanyId;

interface ICompanyRepository
{
    public function add(Company $company): void;

    public function get(CompanyId $companyCompanyId): Company;
}