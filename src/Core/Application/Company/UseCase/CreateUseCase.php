<?php

namespace App\Core\Application\Company\UseCase;

use App\Core\Application\Contract\ICommandBus;
use App\Core\Domain\Company\Command\Create;

class CreateUseCase
{
    private ICommandBus $commandBus;

    public function __construct(ICommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function execute(CreateRequest $request):CreateResponse
    {
        $response = new CreateResponse();

        $this->commandBus->execute(new Create(
            $request->title,
            $request->debtorLimit
        ));

        $response->created = true;

        return $response;
    }
}