<?php

namespace App\Core\Domain\Event\Invoice;

use App\Core\Domain\Model\ValueObject\Invoice\InvoiceId;

final class InvoiceCreated
{
    private InvoiceId $invoiceId;

    public function __construct(InvoiceId $id)
    {
        $this->invoiceId = $id;
    }

    public function invoiceId(): InvoiceId
    {
        return $this->invoiceId;
    }
}