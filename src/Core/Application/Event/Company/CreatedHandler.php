<?php

namespace App\Core\Application\Event\Company;


use App\Core\Domain\Event\Company\Created;

final class CreatedHandler
{
    private IDoSomething $doSomething;

    public function __construct(IDoSomething $doSomething)
    {
        $this->doSomething = $doSomething;
    }

    public function __invoke(Created $created)
    {
        $this->doSomething->execute($created->companyId());
    }
}