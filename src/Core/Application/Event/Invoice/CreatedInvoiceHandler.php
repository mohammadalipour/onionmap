<?php

namespace App\Core\Application\Event\Invoice;


use App\Core\Domain\Event\Invoice\InvoiceCreated;
use Exception;

final class CreatedInvoiceHandler
{
    private IDoSomething $doSomething;

    public function __construct(IDoSomething $doSomething)
    {
        $this->doSomething = $doSomething;
    }

    public function __invoke(InvoiceCreated $created)
    {
        try {
            $this->doSomething->execute($created->invoiceId());
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}