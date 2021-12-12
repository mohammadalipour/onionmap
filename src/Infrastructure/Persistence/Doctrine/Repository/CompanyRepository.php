<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Core\Domain\Model\Entity\Company;
use App\Core\Domain\Model\ValueObject\Company\CompanyId;
use App\Core\Domain\Repository\ICompanyRepository;
use App\Infrastructure\Persistence\Exception\CompanyNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class CompanyRepository extends ServiceEntityRepository implements ICompanyRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Company::class);
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(Company $company): void
    {
        $this->getEntityManager()->persist($company);
    }

    /**
     * @param CompanyId $companyId
     * @return Company
     * @throws CompanyNotFoundException
     */
    public function get(CompanyId $companyId): Company
    {
        $company = $this->find($companyId);

        if (!$company instanceof Company) {
            throw CompanyNotFoundException::byId($companyId);
        }

        return $company;
    }
}