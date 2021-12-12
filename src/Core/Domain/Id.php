<?php

namespace App\Core\Domain;

use App\Core\Domain\Validation\IsNumeric\IsNumeric;

abstract class Id
{
    private $id;

    final private function __construct($id)
    {
        $this->isNumeric($id);
        $this->id = $id;
    }

    public function __toString(): string
    {
        return $this->id;
    }

    /**
     * @throws \Exception
     */
    public static function generate(): static
    {
        return new static(id: random_int(1000,100000));
    }

    private function isNumeric(int $id)
    {
        IsNumeric::execute($id);
    }
}