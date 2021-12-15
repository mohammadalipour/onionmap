<?php

namespace App\Core\Application\UseCase\Invoice;


interface ICreateInvoicePresenter
{
    public function present(CreateInvoiceResponse $createResponse);
}