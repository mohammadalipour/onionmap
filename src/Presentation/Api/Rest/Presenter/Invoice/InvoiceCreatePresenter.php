<?php

namespace App\Presentation\Api\Rest\Presenter\Invoice;

use App\Core\Application\UseCase\Invoice\InvoiceCreateResponse;
use App\Core\Application\UseCase\Invoice\IInvoiceCreatePresenter;
use App\Presentation\Api\Rest\Model\Invoice\CreateInvoiceModel;

class InvoiceCreatePresenter implements IInvoiceCreatePresenter
{
    public function present(InvoiceCreateResponse $createResponse): CreateInvoiceModel
    {
        $model = new CreateInvoiceModel();
        $model->sellerId = $createResponse->sellerId;
        $model->customerId = $createResponse->customerId;
        $model->status = $createResponse->status;
        $model->cost = $createResponse->cost;
        $model->title = $createResponse->title;
        $model->type = $createResponse->type;
        $model->quantity = $createResponse->quantity;

        return $model;
    }
}