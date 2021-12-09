<?php

namespace App\Core\Domain;

trait RaiseEvents
{
    protected array $events;

    /**
     * @param object $event
     * @return void
     */
    public function raise(object $event): void
    {
        $this->events[] = $event;
    }

    /**
     * @return array
     */
    public final function pop(): array
    {
        $events = $this->events;

        $this->events = [];

        return $events;
    }
}