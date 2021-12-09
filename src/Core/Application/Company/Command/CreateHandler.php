<?php

namespace App\Core\Application\Company\Command;

use App\Core\Application\Contract\IEventBus;
use App\Core\Domain\Company\Command\Create;
use App\Core\Domain\Company\Model\Entity\Company;
use App\Core\Domain\Company\Repository\ICompanyRepository;

final class CreateHandler
{
    private IEventBus $busEvent;
    private ICompanyRepository $companyRepository;

    public function __construct(IEventBus $busEvent, ICompanyRepository $companyRepository)
    {
        $this->busEvent = $busEvent;
        $this->companyRepository = $companyRepository;
    }

    public function __invoke(Create $create): void
    {
        $company = Company::create($create);
        $this->companyRepository->add($company);

        $this->busEvent->dispatchAll($company->pop());
    }
}