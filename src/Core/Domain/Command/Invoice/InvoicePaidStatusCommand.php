<?php

namespace App\Core\Domain\Command\Invoice;

final class InvoicePaidStatusCommand
{
    private int $invoiceId;

    public function __construct(
        int $invoiceId,
    )
    {
        $this->invoiceId = $invoiceId;
    }

    public function invoiceId(): int
    {
        return $this->invoiceId;
    }
}