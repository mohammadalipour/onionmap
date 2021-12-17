<?php

namespace App\Test\Unit\Core\Application\Command\Company;

use App\Core\Application\Command\Company\CompanyCreatedCommandHandler;
use App\Core\Application\Contract\IEventBus;
use App\Core\Domain\Command\Company\CompanyCreateCommand;
use App\Core\Domain\Model\Entity\Company;
use App\Core\Domain\Repository\ICompanyRepository;
use PHPUnit\Framework\TestCase;

class CompanyCreatedCommandHandlerTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function test_it_creates_company_when_invoked()
    {
        $title = 'test_company';
        $debtorLimit = 6000;

        $repository = $this->createMock(ICompanyRepository::class);
        $repository->expects(self::once())
            ->method('add')
            ->with(self::callback(
                fn(Company $company): bool => $company->title() === $title
                    && $company->debtorLimit() === $debtorLimit));

        $eventBus = $this->createMock(IEventBus::class);
        $eventBus->expects(self::once())
            ->method('dispatchAll')
            ->with($repository);

        $command = new CompanyCreateCommand($title, $debtorLimit);
        $handler = new CompanyCreatedCommandHandler($eventBus,$repository);

        try {
            $handler($command);
        } catch (\Exception $e) {
            if (!str_contains($e->getMessage(), 'id must not be accessed before initialization')) {
                throw $e;
            }
        }
    }
}