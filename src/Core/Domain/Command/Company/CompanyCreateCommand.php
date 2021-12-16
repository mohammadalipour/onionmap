<?php

namespace App\Core\Domain\Command\Company;

final class CompanyCreateCommand
{
    private string $title;
    private int $debtorLimit;

    public function __construct(string $title, int $debtorLimit)
    {
        $this->title = $title;
        $this->debtorLimit = $debtorLimit;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function debtorLimit(): int
    {
        return $this->debtorLimit;
    }
}