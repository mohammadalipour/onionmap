<?php

namespace App\Core\Application\Event\Invoice;


use App\Core\Domain\Event\Invoice\InvoiceCreatedEvent;

final class InvoiceCreatedEventHandler
{
    private IDoSomething $doSomething;

    public function __construct(IDoSomething $doSomething)
    {
        $this->doSomething = $doSomething;
    }

    public function __invoke(InvoiceCreatedEvent $created)
    {
        $this->doSomething->execute($created->invoiceId());
    }
}