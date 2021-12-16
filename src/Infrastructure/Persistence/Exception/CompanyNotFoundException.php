<?php

namespace App\Infrastructure\Persistence\Exception;


use App\Core\Domain\Id;

final class CompanyNotFoundException extends EntityNotFoundException
{
    /**
     * @param Id $id
     * @return static
     */
    public static function byId(Id $id): self
    {
        return new self(sprintf('Company not found with id "%s"', $id));
    }
}
