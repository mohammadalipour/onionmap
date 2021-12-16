<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Core\Domain\Id;
use App\Core\Domain\Model\Entity\Invoice;
use App\Core\Domain\Model\ValueObject\Invoice\CustomerId;
use App\Core\Domain\Repository\IInvoiceRepository;
use App\Infrastructure\Persistence\Exception\Invoice\InvoiceDebtorLimitException;
use App\Infrastructure\Persistence\Exception\Invoice\InvoiceNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

final class InvoiceRepository extends ServiceEntityRepository implements IInvoiceRepository
{
    private string $invoice = Invoice::class;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, $this->invoice);
    }

    /**
     * @param Id $invoiceId
     * @return Invoice
     * @throws InvoiceNotFoundException
     */
    public function get(Id $invoiceId): Invoice
    {
        $invoice = $this->find($invoiceId->toString());

        if (!$invoice instanceof Invoice) {
            throw InvoiceNotFoundException::byId($invoiceId);
        }

        return $invoice;
    }

    /**
     * @param Invoice $invoice
     * @throws InvoiceDebtorLimitException
     * @throws Exception
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function addWithLimitCondition(Invoice $invoice): void
    {
        if ($this->isGreaterDebtorLimit($invoice->customerId())) {
            throw InvoiceDebtorLimitException::execute();
        }

        $this->add($invoice);
    }

    /**
     * @throws Exception
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
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function add(Invoice $invoice): void
    {
        $this->getEntityManager()->persist($invoice);
        $this->getEntityManager()->flush();
    }
}