<?php

namespace App\Infrastructure\Notification;

use App\Core\Application\Company\Event\IDoSomething;
use App\Core\Domain\Company\Model\ValueObject\CompanyId;

final class DoSomething implements IDoSomething
{

    public function execute(CompanyId $id): CompanyId
    {
        return $id;
    }
}