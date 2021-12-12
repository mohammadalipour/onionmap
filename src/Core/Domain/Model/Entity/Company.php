<?php

namespace App\Core\Domain\Model\Entity;

use App\Core\Domain\Command\Company\Create;
use App\Core\Domain\Event\Company\Created;
use App\Core\Domain\Model\ValueObject\Company\CompanyId;
use App\Core\Domain\Model\ValueObject\Company\DebtorLimit;
use App\Core\Domain\Model\ValueObject\Company\Title;
use App\Core\Domain\Id;
use App\Core\Domain\RaiseEvents;
use App\Core\Domain\Time;

class Company
{
    use RaiseEvents;

    private $id;
    private Title $title;
    private DebtorLimit $debtorLimit;
    private \DateTimeInterface $createdAt;

    /**
     * @throws \Exception
     */
    public function __construct(Title $title, DebtorLimit $debtorLimit)
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

    /**
     * @throws \Exception
     */
    public static function create(Create $create):self
    {
        return new self(
            new Title($create->title()),
            new DebtorLimit($create->debtorLimit())
        );
    }
}