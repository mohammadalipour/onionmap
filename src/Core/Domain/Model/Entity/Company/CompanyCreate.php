<?php

namespace App\Core\Domain\Model\Entity\Company;

use App\Core\Domain\Command\Company\CompanyCreateCommand;
use App\Core\Domain\Model\Entity\Company;
use App\Core\Domain\Model\ValueObject\Company\DebtorLimit;
use App\Core\Domain\Model\ValueObject\Company\Title;

class CompanyCreate
{
    /**
     * @param CompanyCreateCommand $create
     * @return Company
     * @throws \Exception
     */
    public static function create(CompanyCreateCommand $create): Company
    {
        return new Company(
            new Title($create->title()),
            new DebtorLimit($create->debtorLimit())
        );
    }
}