<?php

namespace App\Core\Application\Contract;

interface IQueryBus
{
    public function query(object $query);
}