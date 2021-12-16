<?php

namespace App\Core\Application\UseCase\Invoice;

class InvoiceCreateResponse
{
    public int $sellerId;
    public int $customerId;
    public int $cost;
    public int $quantity;
    public string $title;
    public string $type;
    public string $status;
}