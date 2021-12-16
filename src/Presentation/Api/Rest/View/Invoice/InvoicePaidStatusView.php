<?php

namespace App\Presentation\Api\Rest\View\Invoice;

use App\Infrastructure\Framework\Form\FormRegistry;
use App\Presentation\Api\Rest\DTO\ResultCollection;
use App\Presentation\Api\Rest\Model\Invoice\UpdateInvoiceStatusModel;

final class InvoicePaidStatusView
{
    private FormRegistry $formRegistry;

    public function __construct(FormRegistry $formRegistry)
    {
        $this->formRegistry = $formRegistry;
    }

    public function generate(UpdateInvoiceStatusModel $invoiceModel): ResultCollection
    {
        return new ResultCollection([$invoiceModel]);
    }
}