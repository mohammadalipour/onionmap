<?php

namespace App\Core\Domain\Model\Entity\Invoice;

use App\Core\Domain\Command\Invoice\InvoiceCreateCommand;
use App\Core\Domain\Model\Entity\Invoice;
use App\Core\Domain\Model\ValueObject\Invoice\Cost;
use App\Core\Domain\Model\ValueObject\Invoice\CustomerId;
use App\Core\Domain\Model\ValueObject\Invoice\Quantity;
use App\Core\Domain\Model\ValueObject\Invoice\SellerId;
use App\Core\Domain\Model\ValueObject\Invoice\Status;
use App\Core\Domain\Model\ValueObject\Invoice\Title;
use App\Core\Domain\Model\ValueObject\Invoice\Type;
use Exception;

class InvoiceCreate
{
    /**
     * @throws Exception
     */
    public static function execute(InvoiceCreateCommand $command): Invoice
    {
            return new Invoice(
                new SellerId($command->sellerId()),
                new CustomerId($command->customerId()),
                new Status($command->status()),
                new Quantity($command->quantity()),
                new Cost($command->cost()),
                new Title($command->title()),
                new Type($command->type()),
            );
    }
}