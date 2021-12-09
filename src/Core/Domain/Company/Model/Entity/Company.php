<?php

namespace App\Core\Domain\Company\Model\Entity;

use App\Core\Domain\Company\Command\Create;
use App\Core\Domain\Company\Event\Created;
use App\Core\Domain\Company\Model\ValueObject\CompanyId;
use App\Core\Domain\Company\Model\ValueObject\DebtorLimit;
use App\Core\Domain\Company\Model\ValueObject\Title;
use App\Core\Domain\Id;
use App\Core\Domain\RaiseEvents;
use App\Core\Domain\Time;

class Company
{
    use RaiseEvents;

    private CompanyId $id;
    private Title $title;
    private DebtorLimit $debtorLimit;
    private \DateTimeInterface $createdAt;

    public function __construct(Title $title,DebtorLimit $debtorLimit)
    {
        $this->id = CompanyId::generate();
        $this->title = $title;
        $this->debtorLimit=$debtorLimit;
        $this->createdAt=Time::now();

        $this->raise(new Created($this->id));
    }

    public function id():CompanyId
    {
        return $this->id;
    }

    public function title():Title
    {
        return $this->title;
    }

    public function debtorLimit():DebtorLimit
    {
        return $this->debtorLimit;
    }

    public function createdAt():\DateTimeInterface
    {
        return $this->createdAt;
    }

    public static function create(Create $create):self
    {
        return new self(
            new Title($create->title()),
            new DebtorLimit($create->debtorLimit())
        );
    }
}