<?php

namespace App\Core\Application\UseCase\Invoice;

use App\Core\Application\Contract\ICommandBus;
use App\Core\Domain\Command\Invoice\InvoiceCreate;

class CreateInvoiceUseCase
{
    private ICommandBus $commandBus;

    public function __construct(ICommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function execute(CreateInvoiceRequest $request): CreateInvoiceResponse
    {
        try {
            $response = new CreateInvoiceResponse();

            $this->commandBus->execute(new InvoiceCreate(
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
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }
}