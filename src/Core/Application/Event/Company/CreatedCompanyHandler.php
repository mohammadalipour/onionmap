<?php

namespace App\Core\Application\Event\Company;


use App\Core\Domain\Event\Company\CompanyCreatedEvent;

final class CreatedCompanyHandler
{
    private IDoSomething $doSomething;

    public function __construct(IDoSomething $doSomething)
    {
        $this->doSomething = $doSomething;
    }

    /**
     * @param CompanyCreatedEvent $created
     */
    public function __invoke(CompanyCreatedEvent $created)
    {
        $this->doSomething->execute($created->companyId());
    }
}