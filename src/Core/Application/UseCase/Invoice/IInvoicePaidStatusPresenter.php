<?php

namespace App\Core\Application\UseCase\Invoice;


interface IInvoicePaidStatusPresenter
{
    public function present(InvoicePaidStatusResponse $response);
}