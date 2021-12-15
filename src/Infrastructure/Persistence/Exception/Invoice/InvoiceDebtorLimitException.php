<?php

namespace App\Infrastructure\Persistence\Exception\Invoice;


use App\Infrastructure\Persistence\Exception\EntityCreatedException;

final class InvoiceDebtorLimitException extends EntityCreatedException
{
    /**
     * @return static
     */
    public static function execute(): self
    {
        return new self(sprintf("Invoice amount is greater than the company's maximum debtor limit"));
    }
}
