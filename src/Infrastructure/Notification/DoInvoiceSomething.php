<?php

namespace App\Infrastructure\Notification;

use App\Core\Application\Event\Invoice\IDoSomething;
use App\Core\Domain\Model\ValueObject\Invoice\InvoiceId;
use App\Core\Domain\Repository\IInvoiceRepository;

final class DoInvoiceSomething implements IDoSomething
{
    private IInvoiceRepository $invoiceRepository;

    public function __construct(IInvoiceRepository $IInvoiceRepository)
    {
        $this->invoiceRepository = $IInvoiceRepository;
    }

    public function execute(InvoiceId $id): void
    {
        $invoice = $this->invoiceRepository->get($id);

        return;
    }
}