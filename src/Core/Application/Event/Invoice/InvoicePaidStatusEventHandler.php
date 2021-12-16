<?php

namespace App\Core\Application\Event\Invoice;


use App\Core\Domain\Event\Invoice\InvoicePaidStatusEvent;

final class InvoicePaidStatusEventHandler
{
    private IDoSomething $doSomething;

    public function __construct(IDoSomething $doSomething)
    {
        $this->doSomething = $doSomething;
    }

    public function __invoke(InvoicePaidStatusEvent $created)
    {
        $this->doSomething->execute($created->invoiceId());
    }
}