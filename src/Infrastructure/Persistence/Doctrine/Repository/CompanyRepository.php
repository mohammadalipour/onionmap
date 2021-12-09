<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Core\Domain\Company\Model\Entity\Company;
use App\Core\Domain\Company\Model\ValueObject\CompanyId;
use App\Core\Domain\Company\Repository\ICompanyRepository;
use App\Infrastructure\Persistence\Exception\CompanyNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class CompanyRepository extends ServiceEntityRepository implements ICompanyRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Company::class);
    }

    public function add(Company $company): void
    {
        $this->getEntityManager()->persist($company);
    }

    /**
     * @param CompanyId $id
     * @return Company
     * @throws CompanyNotFoundException
     */
    public function get(CompanyId $id): Company
    {
        $company = $this->find($id);

        if (!$company instanceof Company) {
            throw CompanyNotFoundException::byId($id);
        }

        return $company;
    }
}