<?php

namespace App\Infrastructure\Persistence\Exception;


use App\Core\Domain\Company\Model\ValueObject\CompanyId;

final class CompanyNotFoundException extends EntityNotFoundException
{
    /**
     * @param CompanyId $id
     * @return static
     */
    public static function byId(CompanyId $id): self
    {
        return new self(sprintf('Company not found with id "%s"', $id));
    }
}
