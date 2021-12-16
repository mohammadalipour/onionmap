<?php

namespace App\Core\Application\Command\Company;

use App\Core\Application\Contract\IEventBus;
use App\Core\Domain\Command\Company\CompanyCreateCommand;
use App\Core\Domain\Model\Entity\Company;
use App\Core\Domain\Repository\ICompanyRepository;
use Exception;

final class CompanyCreatedHandler
{
    private IEventBus $busEvent;
    private ICompanyRepository $companyRepository;

    public function __construct(IEventBus $busEvent, ICompanyRepository $companyRepository)
    {
        $this->busEvent = $busEvent;
        $this->companyRepository = $companyRepository;
    }

    /**
     * @param CompanyCreateCommand $create
     * @throws Exception
     */
    public function __invoke(CompanyCreateCommand $create): void
    {
        $company = Company::create($create);
        $this->companyRepository->add($company);
        $this->busEvent->dispatchAll($company->pop());

    }
}