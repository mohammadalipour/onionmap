<?php

namespace App\Infrastructure\Framework\MessageBus;

use App\Core\Application\Contract\IQueryBus;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class QueryBus implements IQueryBus
{
    private MessageBusInterface $queryBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->queryBus = $messageBus;
    }

    /**
     * @param object $query
     * @return mixed
     */
    public function query(object $query)
    {
        $envelope = $this->queryBus->dispatch($query);

        /** @var HandledStamp $handled */
        $handled = $envelope->last(HandledStamp::class);

        return $handled->getResult();
    }
}