<?php

namespace App\Core\Application\UseCase\Invoice;

use App\Core\Application\Contract\ICommandBus;
use App\Core\Domain\Command\Invoice\InvoiceCreateCommand;
use App\Core\Domain\Command\Invoice\InvoicePaidStatusCommand;

class InvoicePaidStatusUseCase
{
    private ICommandBus $commandBus;

    public function __construct(ICommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @param InvoicePaidStatusRequest $request
     * @return InvoicePaidStatusResponse
     */
    public function execute(InvoicePaidStatusRequest $request): InvoicePaidStatusResponse
    {
            $response = new InvoicePaidStatusResponse();
            $this->commandBus->execute(new InvoicePaidStatusCommand(
                $request->invoiceId,
            ));
            $response->invoiceId = $request->invoiceId;

            return $response;
    }
}