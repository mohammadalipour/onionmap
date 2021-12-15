<?php

namespace App\Core\Domain\Command\Company;

use App\Core\Domain\Model\ValueObject\Company\CompanyId;
use App\Core\Domain\Model\ValueObject\Company\DebtorLimit;
use App\Core\Domain\Model\ValueObject\Company\Title;

final class CompanyCreate
{
    private string $title;
    private int $debtorLimit;

    public function __construct(string $title,int $debtorLimit)
    {
        $this->title = $title;
        $this->debtorLimit =$debtorLimit;
    }

    /**
     * @return string
     */
    public function title():string
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function debtorLimit():int
    {
        return $this->debtorLimit;
    }
}