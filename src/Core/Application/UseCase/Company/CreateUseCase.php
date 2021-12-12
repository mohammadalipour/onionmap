<?php

namespace App\Core\Application\UseCase\Company;

use App\Core\Application\Contract\ICommandBus;
use App\Core\Domain\Command\Company\Create;

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

        $response->title = $request->title;
        $response->debtorLimit = $request->debtorLimit;

        return $response;
    }
}