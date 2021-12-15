<?php

namespace App\Core\Domain\Repository;

use App\Core\Domain\Model\Entity\Invoice;
use App\Core\Domain\Model\ValueObject\Invoice\CustomerId;
use App\Core\Domain\Model\ValueObject\Invoice\InvoiceId;

interface IInvoiceRepository
{
    public function add(Invoice $invoice): void;

    public function addWithLimitCondition(Invoice $invoice): void;

    public function get(InvoiceId $companyInvoiceId): Invoice;

    public function isGreaterDebtorLimit(CustomerId $company): bool;
}