<?php

namespace App\Core\Application\Event\Company;


use App\Core\Domain\Event\Company\CompanyCreated;
use Exception;

final class CreatedCompanyHandler
{
    private IDoSomething $doSomething;

    public function __construct(IDoSomething $doSomething)
    {
        $this->doSomething = $doSomething;
    }

    public function __invoke(CompanyCreated $created)
    {
        try {
            $this->doSomething->execute($created->companyId());
        } catch (Exception $exception) {
            dd($exception);
        }
    }
}