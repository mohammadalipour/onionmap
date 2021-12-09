<?php

namespace App\Core\Application\Company\Event;

use App\Core\Domain\Company\Model\ValueObject\CompanyId;

interface IDoSomething
{
    public function execute(CompanyId $id);
}