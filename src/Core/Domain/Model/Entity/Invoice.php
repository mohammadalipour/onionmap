<?php

namespace App\Core\Domain\Model\Entity;

use App\Core\Domain\Command\Invoice\InvoiceCreateCommand;
use App\Core\Domain\Event\Invoice\InvoiceCreatedEvent;
use App\Core\Domain\Event\Invoice\InvoicePaidStatusEvent;
use App\Core\Domain\Id;
use App\Core\Domain\Model\Entity\Invoice\InvoiceCreate;
use App\Core\Domain\Model\ValueObject\Invoice\Cost;
use App\Core\Domain\Model\ValueObject\Invoice\CustomerId;
use App\Core\Domain\Model\ValueObject\Invoice\InvoiceId;
use App\Core\Domain\Model\ValueObject\Invoice\Quantity;
use App\Core\Domain\Model\ValueObject\Invoice\SellerId;
use App\Core\Domain\Model\ValueObject\Invoice\Status;
use App\Core\Domain\Model\ValueObject\Invoice\Title;
use App\Core\Domain\Model\ValueObject\Invoice\Type;
use App\Core\Domain\RaiseEvents;
use App\Core\Domain\Time;
use DateTimeInterface;
use Exception;

class Invoice
{
    use RaiseEvents;

    protected $id;
    protected SellerId $sellerId;
    protected CustomerId $customerId;
    protected Status $status;
    protected Quantity $quantity;
    protected Cost $cost;
    protected Title $title;
    protected Type $type;
    protected DateTimeInterface $createdAt;


    /**
     * @throws Exception
     */
    public function __construct(
        SellerId   $sellerId,
        CustomerId $customerId,
        Status     $status,
        Quantity   $quantity,
        Cost       $cost,
        Title      $title,
        Type       $type
    )
    {
        $this->id = InvoiceId::generate();
        $this->sellerId = $sellerId;
        $this->customerId = $customerId;
        $this->status = $status;
        $this->type = $type;
        $this->quantity = $quantity;
        $this->cost = $cost;
        $this->title = $title;
        $this->createdAt = Time::now();

        $this->raise(new InvoiceCreatedEvent($this->id));
    }

    /**
     * @param InvoiceCreateCommand $create
     * @return Invoice
     * @throws Exception
     */
    public static function create(InvoiceCreateCommand $create): self
    {
        return InvoiceCreate::execute($create);
    }

    public function setId(Id $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setQuantity(Quantity $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function id(): InvoiceId
    {
        return $this->id;
    }

    public function sellerId(): SellerId
    {
        return $this->sellerId;
    }

    public function customerId(): CustomerId
    {
        return $this->customerId;
    }

    public function status(): Status
    {
        return $this->status;
    }

    public function quantity(): Quantity
    {
        return $this->quantity;
    }

    public function cost(): Cost
    {
        return $this->cost;
    }

    public function type(): Type
    {
        return $this->type;
    }

    public function title(): Title
    {
        return $this->title;
    }

    public function createdAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function paid(): void
    {
        $this->setStatus(new Status(Status::PAID_STATUS));

        $this->raise(new InvoicePaidStatusEvent($this->id));
    }

    public function setStatus(Status $status): self
    {
        $this->status = $status;

        return $this;
    }
}