<?php

namespace App\Core\Domain\Repository;

use App\Core\Domain\Id;
use App\Core\Domain\Model\Entity\Invoice;
use App\Core\Domain\Model\ValueObject\Invoice\CustomerId;

interface IInvoiceRepository
{
    public function add(Invoice $invoice): void;

    public function addWithLimitCondition(Invoice $invoice): void;

    public function get(Id $companyInvoiceId): Invoice;

    public function isGreaterDebtorLimit(CustomerId $company): bool;
}