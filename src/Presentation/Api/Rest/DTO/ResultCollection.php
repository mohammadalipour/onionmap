<?php

namespace App\Presentation\Api\Rest\DTO;

final class ResultCollection implements IResultCollection
{
    private array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function getSingleResult()
    {
        return reset($this->items);
    }

    /**
     * Hydrate our result to a DTO object
     */
    public function hydrateSingleResultAs(ConstructFromArrayInterface $constructFromArray)
    {
        $item = $this->getSingleResult();

        return $constructFromArray::fromArray($item);
    }
}