<?php

namespace App\Core\Domain\Repository;

use App\Core\Domain\Id;
use App\Core\Domain\Model\Entity\Company;

interface ICompanyRepository
{
    public function add(Company $company): void;

    public function get(Id $companyCompanyId): Company;
}