<?php

namespace App\Core\Application\Command\Invoice;

use App\Core\Application\Contract\IEventBus;
use App\Core\Domain\Command\Invoice\InvoiceCreate;
use App\Core\Domain\Model\Entity\Invoice;
use App\Core\Domain\Repository\IInvoiceRepository;
use Exception;

final class CreateInvoiceHandler
{
    private IEventBus $busEvent;
    private IInvoiceRepository $IInvoiceRepository;

    public function __construct(IEventBus $busEvent, IInvoiceRepository $IInvoiceRepository)
    {
        $this->busEvent = $busEvent;
        $this->IInvoiceRepository = $IInvoiceRepository;
    }

    /**
     * @throws Exception
     */
    public function __invoke(InvoiceCreate $create): void
    {
        try {
            $company = Invoice::create($create);

            $this->IInvoiceRepository->addWithLimitCondition($company);

            $this->busEvent->dispatchAll($company->pop());
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}