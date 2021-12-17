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
    /*
     * $executionDay = (new \DateTimeImmutable())->setTime(0, 0);
            $title = 'Some title';
            $description = 'Some description';

            $repository = $this->createMock(TaskRepositoryInterface::class);
            $repository->expects(self::once())
                ->method('add')
                ->with(self::callback(
                    fn(Task $task): bool => $task->getTitle() === $title
                        && $task->getDescription() === $description
                        && $task->getExecutionDay() == $executionDay
                ));

            $userFetcher = $this->createMock(UserFetcherInterface::class);
            $userFetcher->method('fetchRequiredUser')->willReturn(new User('name', 'pass_hash', $this->getUniqueUsernameSpecification()));

            $command = new CreateTaskCommand($title, $executionDay, $description);
            $handler = new CreateTaskCommandHandler($repository, $userFetcher);

            try {
                $handler($command);
            } catch (\Error $e) {
                // php7.4 fix
                if (strpos($e->getMessage(), 'id must not be accessed before initialization') === false) {
                    throw $e;
                }
            }
     */

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