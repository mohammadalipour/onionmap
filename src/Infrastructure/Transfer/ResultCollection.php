<?php

namespace App\Infrastructure\Transfer;

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
     * @param ConstructFromArrayInterface $constructFromArray
     * @return mixed
     */
    public function hydrateSingleResultAs(ConstructFromArrayInterface $constructFromArray): mixed
    {
        $item = $this->getSingleResult();

        return $constructFromArray::fromArray($item);
    }
}