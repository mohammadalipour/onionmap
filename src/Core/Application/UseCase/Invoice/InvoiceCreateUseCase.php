<?php

namespace App\Core\Application\UseCase\Invoice;

use App\Core\Application\Contract\ICommandBus;
use App\Core\Domain\Command\Invoice\InvoiceCreateCommand;

class InvoiceCreateUseCase
{
    private ICommandBus $commandBus;

    public function __construct(ICommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @param InvoiceCreateRequest $request
     * @return InvoiceCreateResponse
     */
    public function execute(InvoiceCreateRequest $request): InvoiceCreateResponse
    {
        $response = new InvoiceCreateResponse();

        $this->commandBus->execute(new InvoiceCreateCommand(
            $request->sellerId,
            $request->customerId,
            $request->status,
            $request->cost,
            $request->type,
            $request->title,
            $request->quantity,
        ));

        $response->sellerId = $request->sellerId;
        $response->customerId = $request->customerId;
        $response->status = $request->status;
        $response->quantity = $request->quantity;
        $response->cost = $request->cost;
        $response->title = $request->title;
        $response->type = $request->type;

        return $response;
    }
}