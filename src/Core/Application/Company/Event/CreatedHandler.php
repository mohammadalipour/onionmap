<?php

namespace App\Core\Application\Company\Event;

use App\Core\Domain\Company\Event\Created;

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