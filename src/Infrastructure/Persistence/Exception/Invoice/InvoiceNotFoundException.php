<?php

namespace App\Infrastructure\Persistence\Exception\Invoice;


use App\Core\Domain\Model\ValueObject\Invoice\InvoiceId;
use App\Infrastructure\Persistence\Exception\EntityNotFoundException;

final class InvoiceNotFoundException extends EntityNotFoundException
{
    /**
     * @param InvoiceId $id
     * @return static
     */
    public static function byId(InvoiceId $id): self
    {
        return new self(sprintf('Invoice not found with id "%s"', $id));
    }
}
