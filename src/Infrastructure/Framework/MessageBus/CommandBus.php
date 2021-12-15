<?php

namespace App\Infrastructure\Framework\MessageBus;

use App\Core\Application\Contract\ICommandBus;
use Symfony\Component\Messenger\MessageBusInterface;

final class CommandBus implements ICommandBus
{
    private MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @throws \Exception
     */
    public function execute(object $command): void
    {
        try {
            $this->commandBus->dispatch($command);
        }catch (\Exception $exception){
            throw new \Exception($exception->getPrevious()->getMessage());
        }
    }
}