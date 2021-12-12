<?php

namespace App\Infrastructure\Framework\Form;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

final class FormRegistry
{
    private FormFactoryInterface $formFactory;

    private array $forms = [];

    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function createForm(string $type, $data = null, array $options = []): FormInterface
    {
        $this->forms[$type] = $this->formFactory->create($type, $data, $options);

        return $this->forms[$type];
    }

    public function getForm(string $type): ?FormInterface
    {
        return $this->forms[$type] ?? null;
    }
}
