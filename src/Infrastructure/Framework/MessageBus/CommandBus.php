<?php

namespace App\Infrastructure\Framework\MessageBus;

use App\Core\Application\Contract\ICommandBus;
use Exception;
use Symfony\Component\Messenger\MessageBusInterface;

final class CommandBus implements ICommandBus
{
    private MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @param object $command
     */
    public function execute(object $command): void
    {
        $this->commandBus->dispatch($command);
    }
}