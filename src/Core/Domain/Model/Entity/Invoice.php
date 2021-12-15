<?php

namespace App\Core\Domain\Model\Entity;

use App\Core\Domain\Command\Invoice\InvoiceCreate;
use App\Core\Domain\Event\Invoice\InvoiceCreated;
use App\Core\Domain\Model\ValueObject\Invoice\CompanyId;
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

    private $id;
    private SellerId $sellerId;
    private CustomerId $customerId;
    private Status $status;
    private Quantity $quantity;
    private Cost $cost;
    private Title $title;
    private Type $type;
    private DateTimeInterface $createdAt;


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

        $this->raise(new InvoiceCreated($this->id));
    }

    /**
     * @throws Exception
     */
    public static function create(InvoiceCreate $create): self
    {
        try {
            return new self(
                new SellerId($create->sellerId()),
                new CustomerId($create->customerId()),
                new Status($create->status()),
                new Quantity($create->quantity()),
                new Cost($create->cost()),
                new Title($create->title()),
                new Type($create->type()),
            );
        }catch (Exception $exception){
            dd($exception->getMessage());
        }

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

}