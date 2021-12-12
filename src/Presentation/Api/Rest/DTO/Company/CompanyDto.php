<?php

namespace App\Presentation\Api\Rest\DTO\Company;

use App\Core\Domain\Company\Model\ValueObject\CompanyId;
use App\Presentation\Api\Rest\DTO\ConstructableFromArrayTrait;
use App\Presentation\Api\Rest\DTO\ConstructFromArrayInterface;

final class CompanyDto implements ConstructFromArrayInterface
{
    use ConstructableFromArrayTrait;

    private CompanyId $companyId;
    private string $title;
    private int $debtorLimit;

    public function __construct(CompanyId $companyId,string $title, int $debtorLimit)
    {
        $this->companyId = $companyId;
        $this->title = $title;
        $this->debtorLimit = $debtorLimit;
    }

    public function companyId():CompanyId
    {
        return $this->companyId;
    }

    public function title():string
    {
        return $this->title;
    }

    public function debtorLimit():int
    {
        return $this->debtorLimit;
    }

}