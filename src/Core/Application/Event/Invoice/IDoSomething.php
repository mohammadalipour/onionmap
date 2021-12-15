<?php

namespace App\Core\Application\Event\Invoice;

use App\Core\Domain\Model\ValueObject\Invoice\InvoiceId;

interface IDoSomething
{
    public function execute(InvoiceId $id);
}