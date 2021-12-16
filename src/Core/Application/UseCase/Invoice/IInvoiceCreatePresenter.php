<?php

namespace App\Core\Application\UseCase\Invoice;


interface IInvoiceCreatePresenter
{
    public function present(InvoiceCreateResponse $createResponse);
}