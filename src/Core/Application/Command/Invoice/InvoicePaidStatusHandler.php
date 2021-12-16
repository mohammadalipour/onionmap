<?php

namespace App\Core\Application\Command\Invoice;

use App\Core\Application\Contract\IEventBus;
use App\Core\Domain\Command\Invoice\InvoicePaidStatusCommand;
use App\Core\Domain\Model\ValueObject\Invoice\InvoiceId;
use App\Core\Domain\Model\ValueObject\Invoice\Status;
use App\Core\Domain\Repository\IInvoiceRepository;

final class InvoicePaidStatusHandler
{
    private IEventBus $busEvent;
    private IInvoiceRepository $IInvoiceRepository;

    public function __construct(IEventBus $busEvent, IInvoiceRepository $IInvoiceRepository)
    {
        $this->busEvent = $busEvent;
        $this->IInvoiceRepository = $IInvoiceRepository;
    }

    /**
     * @param InvoicePaidStatusCommand $command
     */
    public function __invoke(InvoicePaidStatusCommand $command): void
    {
        $id = InvoiceId::fromString($command->invoiceId());

        $invoice = $this->IInvoiceRepository->get($id);
        $invoice->paid();
        $this->IInvoiceRepository->add($invoice);

        $this->busEvent->dispatchAll($invoice->pop());
    }
}