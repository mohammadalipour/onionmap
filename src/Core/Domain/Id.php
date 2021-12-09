<?php

namespace App\Core\Domain;

abstract class Id
{
    private string $id;

    final private function __construct(string $id)
    {
        $this->isValidUuid($id);
        $this->id = $id;
    }

    public function __toString(): string
    {
        return $this->id;
    }

    public static function generate(): static
    {
        return new static(uniqid());
    }

    /**
     * @param string $value
     * @return bool
     * @throws \Exception
     */
    private function isValidUuid(string $value): bool
    {
        $value = \str_replace(['urn:', 'uuid:', '{', '}'], '', $value);

        if (!\preg_match('/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{12}$/', $value)) {
            throw new \Exception('');
        }

        return true;
    }
}