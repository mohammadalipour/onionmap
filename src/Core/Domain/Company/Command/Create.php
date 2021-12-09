<?php

namespace App\Core\Domain\Company\Command;

use App\Core\Domain\Company\Model\ValueObject\CompanyId;
use App\Core\Domain\Company\Model\ValueObject\DebtorLimit;
use App\Core\Domain\Company\Model\ValueObject\Title;

final class Create
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