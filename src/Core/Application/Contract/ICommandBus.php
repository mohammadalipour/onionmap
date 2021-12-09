<?php

namespace App\Core\Application\Contract;

interface ICommandBus
{
    public function execute(object $command) :void;
}