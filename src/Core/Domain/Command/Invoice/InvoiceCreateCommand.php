<?php

namespace App\Core\Domain\Command\Invoice;

final class InvoiceCreateCommand
{
    private int $sellerId;
    private int $customerId;
    private string $status;
    private string $type;
    private string $title;
    private int $cost;
    private int $quantity;

    public function __construct(
        int    $sellerId,
        int    $customerId,
        string $status,
        int    $cost,
        string $type,
        string $title,
        int    $quantity,
    )
    {
        $this->sellerId = $sellerId;
        $this->customerId = $customerId;
        $this->status = $status;
        $this->cost = $cost;
        $this->quantity = $quantity;
        $this->title = $title;
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function sellerId(): int
    {
        return $this->sellerId;
    }

    /**
     * @return int
     */
    public function customerId(): int
    {
        return $this->customerId;
    }

    /**
     * @return string
     */
    public function status(): string
    {
        return $this->status;
    }


    /**
     * @return int
     */
    public function cost(): int
    {
        return $this->cost;
    }

    /**
     * @return int
     */
    public function quantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->title;
    }

}