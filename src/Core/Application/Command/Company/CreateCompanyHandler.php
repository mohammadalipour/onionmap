<?php

namespace App\Core\Application\Command\Company;

use App\Core\Application\Contract\IEventBus;
use App\Core\Domain\Command\Company\CompanyCreate;
use App\Core\Domain\Model\Entity\Company;
use App\Core\Domain\Repository\ICompanyRepository;

final class CreateCompanyHandler
{
    private IEventBus $busEvent;
    private ICompanyRepository $companyRepository;

    public function __construct(IEventBus $busEvent, ICompanyRepository $companyRepository)
    {
        $this->busEvent = $busEvent;
        $this->companyRepository = $companyRepository;
    }

    /**
     * @throws \Exception
     */
    public function __invoke(CompanyCreate $create): void
    {
        $company = Company::create($create);

        $this->companyRepository->add($company);

        $this->busEvent->dispatchAll($company->pop());
    }
}