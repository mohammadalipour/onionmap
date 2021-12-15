<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Core\Domain\Model\Entity\Invoice;
use App\Core\Domain\Model\ValueObject\Invoice\CustomerId;
use App\Core\Domain\Model\ValueObject\Invoice\InvoiceId;
use App\Core\Domain\Repository\IInvoiceRepository;
use App\Infrastructure\Persistence\Exception\Invoice\InvoiceCreatedException;
use App\Infrastructure\Persistence\Exception\Invoice\InvoiceDebtorLimitException;
use App\Infrastructure\Persistence\Exception\Invoice\InvoiceNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

final class InvoiceRepository extends ServiceEntityRepository implements IInvoiceRepository
{
    private string $invoice = Invoice::class;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, $this->invoice);
    }

    /**
     * @param InvoiceId $invoiceId
     * @return Invoice
     * @throws InvoiceNotFoundException
     */
    public function get(InvoiceId $invoiceId): Invoice
    {
        $invoice = $this->find($invoiceId);

        if (!$invoice instanceof Invoice) {
            throw InvoiceNotFoundException::byId($invoiceId);
        }

        return $invoice;
    }

    /**
     * @throws ORMException
     * @throws \Doctrine\DBAL\Exception
     * @throws Exception
     */
    public function addWithLimitCondition(Invoice $invoice): void
    {
        if ($this->isGreaterDebtorLimit($invoice->customerId())) {
            throw InvoiceDebtorLimitException::execute();
        }

        $this->add($invoice);
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function isGreaterDebtorLimit(CustomerId $company): bool
    {
        $companyId = $company->customerId();

        $builder = $this->getEntityManager()->getConnection();

        $query = $builder->prepare(
            "select if(sum(i.cost) >= c.debtor_limit, true, false) is_greater
                    from invoices i
                    INNER JOIN companies c ON c.id = i.customer_id
                    where c.id =:companyId"
        );
        $query->bindParam('companyId', $companyId);

        return $query->executeQuery()->fetchOne();
    }

    /**
     * @throws ORMException|InvoiceCreatedException
     */
    public function add(Invoice $invoice): void
    {
        try {
            $this->getEntityManager()->persist($invoice);
            $this->getEntityManager()->flush();
        } catch (Exception) {
            throw InvoiceCreatedException::execute();
        }
    }
}