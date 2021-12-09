<?php

namespace App\Core\Application\Contract;

interface IEventBus
{
    public function dispatch(object $event): void;

    public function dispatchAll(array $events): void;
}