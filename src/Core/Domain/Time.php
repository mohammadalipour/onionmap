<?php

namespace App\Core\Domain;

final class Time
{
    public static function now(): \DateTimeImmutable
    {
        return new \DateTimeImmutable();
    }
}