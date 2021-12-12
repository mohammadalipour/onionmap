<?php

namespace App\Infrastructure\Notification;

use App\Core\Application\Event\Company\IDoSomething;
use App\Core\Domain\Model\ValueObject\Company\CompanyId;
use App\Core\Domain\Repository\ICompanyRepository;

final class DoSomething implements IDoSomething
{
    private ICompanyRepository $companyRepository;

    public function __construct(ICompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function execute(CompanyId $id): void
    {
        $company = $this->companyRepository->get($id);

        return ;
    }
}