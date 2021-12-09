<?php

namespace App\Infrastructure\Framework\MessageBus;

use App\Core\Application\Contract\IEventBus;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

class EventBus implements IEventBus
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function dispatch(object $event): void
    {
        $this->messageBus->dispatch($event, [
            new DispatchAfterCurrentBusStamp()
        ]);
    }

    public function dispatchAll(array $events): void
    {
        foreach ($events as $event) {
            $this->dispatch($event);
        }
    }
}