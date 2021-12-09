<?php

namespace App\Core\Domain\Company\Event;

use App\Core\Domain\Company\Model\ValueObject\CompanyId;

final class Created
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