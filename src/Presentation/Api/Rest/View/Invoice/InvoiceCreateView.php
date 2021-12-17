<?php

namespace App\Presentation\Api\Rest\View\Invoice;

use App\Infrastructure\Framework\Form\FormRegistry;
use App\Infrastructure\Transfer\ResultCollection;
use App\Presentation\Api\Rest\Model\Invoice\CreateInvoiceModel;

final class InvoiceCreateView
{
    private FormRegistry $formRegistry;

    public function __construct(FormRegistry $formRegistry)
    {
        $this->formRegistry = $formRegistry;
    }

    /**
     * @param CreateInvoiceModel $invoiceModel
     * @return ResultCollection
     */
    public function generate(CreateInvoiceModel $invoiceModel): ResultCollection
    {
        return new ResultCollection([$invoiceModel]);
    }
}