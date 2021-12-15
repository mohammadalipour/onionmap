<?php

namespace App\Presentation\Api\Rest\Model\Invoice;

final class CreateInvoiceModel
{
    public int $sellerId;
    public int $customerId;
    public int $cost;
    public int $quantity;
    public string $title;
    public string $type;
    public string $status;
}