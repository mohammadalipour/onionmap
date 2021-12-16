<?php

namespace App\Core\Application\UseCase\Company;

use App\Core\Application\Contract\ICommandBus;
use App\Core\Domain\Command\Company\CompanyCreateCommand;

class CompanyCreateUseCase
{
    private ICommandBus $commandBus;

    public function __construct(ICommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function execute(CreateCompanyRequest $request):CreateCompanyResponse
    {
        try {
            $response = new CreateCompanyResponse();

            $this->commandBus->execute(new CompanyCreateCommand(
                $request->title,
                $request->debtorLimit
            ));

            $response->title = $request->title;
            $response->debtorLimit = $request->debtorLimit;

            return $response;
        }catch (\Exception $exception){
            dd($exception->getMessage());
        }

    }
}