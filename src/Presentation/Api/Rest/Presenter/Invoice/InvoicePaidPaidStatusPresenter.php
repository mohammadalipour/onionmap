<?php

namespace App\Presentation\Api\Rest\Presenter\Invoice;

use App\Core\Application\UseCase\Invoice\InvoiceCreateResponse;
use App\Core\Application\UseCase\Invoice\IInvoiceCreatePresenter;
use App\Core\Application\UseCase\Invoice\IInvoicePaidStatusPresenter;
use App\Core\Application\UseCase\Invoice\InvoicePaidStatusResponse;
use App\Presentation\Api\Rest\Model\Invoice\CreateInvoiceModel;
use App\Presentation\Api\Rest\Model\Invoice\UpdateInvoiceStatusModel;

class InvoicePaidPaidStatusPresenter implements IInvoicePaidStatusPresenter
{
    public function present(InvoicePaidStatusResponse $response): UpdateInvoiceStatusModel
    {
        $model = new UpdateInvoiceStatusModel();
        $model->invoiceId = $response->invoiceId;

        return $model;
    }
}