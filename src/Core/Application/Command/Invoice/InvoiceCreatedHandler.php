<?php

namespace App\Core\Application\Command\Invoice;

use App\Core\Application\Contract\IEventBus;
use App\Core\Domain\Command\Invoice\InvoiceCreateCommand;
use App\Core\Domain\Model\Entity\Invoice;
use App\Core\Domain\Repository\IInvoiceRepository;
use Exception;

final class InvoiceCreatedHandler
{
    private IEventBus $busEvent;
    private IInvoiceRepository $IInvoiceRepository;

    public function __construct(IEventBus $busEvent, IInvoiceRepository $IInvoiceRepository)
    {
        $this->busEvent = $busEvent;
        $this->IInvoiceRepository = $IInvoiceRepository;
    }

    /**
     * @param InvoiceCreateCommand $create
     * @throws Exception
     */
    public function __invoke(InvoiceCreateCommand $create): void
    {
            $invoice = Invoice::create($create);
            $this->IInvoiceRepository->addWithLimitCondition($invoice);

            $this->busEvent->dispatchAll($invoice->pop());
    }
}