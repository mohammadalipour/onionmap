<?php

namespace App\Infrastructure\Persistence\Exception\Invoice;


use App\Core\Domain\Id;
use App\Infrastructure\Persistence\Exception\EntityNotFoundException;

final class InvoiceNotFoundException extends EntityNotFoundException
{
    /**
     * @param Id $id
     * @return static
     */
    public static function byId(Id $id): self
    {
        return new self(sprintf('Invoice not found with id "%s"', $id));
    }
}
