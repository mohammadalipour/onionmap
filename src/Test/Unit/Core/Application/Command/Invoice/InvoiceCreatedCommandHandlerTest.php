<?php

namespace App\Test\Unit\Core\Application\Command\Invoice;

use App\Core\Application\Command\Invoice\InvoiceCreatedCommandHandler;
use App\Core\Application\Contract\IEventBus;
use App\Core\Domain\Command\Invoice\InvoiceCreateCommand;
use App\Core\Domain\Model\Entity\Invoice;
use App\Core\Domain\Repository\IInvoiceRepository;
use Exception;
use PHPUnit\Framework\TestCase;

class InvoiceCreatedCommandHandlerTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test_it_creates_invoice_when_invoked()
    {
        $title = 'test_company';
        $cost = 6000;
        $sellerId = 1;
        $customerId = 1;
        $status = 'pending';
        $type = 'service';
        $quantity = 2;

        $repository = $this->createMock(IInvoiceRepository::class);
        $repository->expects(self::once())
            ->method('add')
            ->with(self::callback(
                fn(Invoice $invoice): bool => $invoice->title() === $title
                    && $invoice->cost() === $cost && $invoice->sellerId() === $sellerId
                    && $invoice->customerId() === $customerId && $invoice->type() === $type
                    && $invoice->status() === $status && $invoice->quantity() === $quantity));

        $eventBus = $this->createMock(IEventBus::class);
        $eventBus->expects(self::once())
            ->method('dispatchAll')
            ->with($repository);

        $command = new InvoiceCreateCommand($title, $sellerId, $customerId, $status, $type, $cost, $quantity);
        $handler = new InvoiceCreatedCommandHandler($eventBus, $repository);

        try {
            $handler($command);
        } catch (Exception $e) {
            if (!str_contains($e->getMessage(), 'id must not be accessed before initialization')) {
                throw $e;
            }
        }
    }
}