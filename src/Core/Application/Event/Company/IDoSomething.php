<?php

namespace App\Core\Application\Event\Company;

use App\Core\Domain\Model\ValueObject\Company\CompanyId;

interface IDoSomething
{
    public function execute(CompanyId $id);
}