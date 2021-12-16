<?php

namespace App\Presentation\Api\Rest\Controller\Invoice;

use App\Core\Application\UseCase\Invoice\InvoiceCreateUseCase;
use App\Infrastructure\Framework\Form\FormRegistry;
use App\Infrastructure\Framework\Form\Type\Invoice\InvoiceCreateType;
use App\Presentation\Api\Rest\Controller\RestApiController;
use App\Presentation\Api\Rest\Presenter\Invoice\InvoiceCreatePresenter;
use App\Presentation\Api\Rest\View\Invoice\InvoiceCreateView;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class InvoiceCreateController extends RestApiController
{
    private FormRegistry $formRegistry;
    private InvoiceCreatePresenter $invoicePresenter;
    private InvoiceCreateUseCase $invoiceCreateUseCase;
    private InvoiceCreateView $InvoiceView;

    public function __construct(
        FormRegistry           $formRegistry,
        InvoiceCreatePresenter $invoicePresenter,
        InvoiceCreateUseCase   $createUseCase,
        InvoiceCreateView      $InvoiceView
    )
    {
        $this->formRegistry = $formRegistry;
        $this->invoicePresenter = $invoicePresenter;
        $this->invoiceCreateUseCase = $createUseCase;
        $this->InvoiceView = $InvoiceView;
    }

    public function __invoke(Request $request)
    {
        try {
            $form = $this->formRegistry->createForm(InvoiceCreateType::class);
            $form->handleRequest($request);
            $form->submit(json_decode($request->getContent(), true));

            if (!$form->isValid()) {
                return new JsonResponse($form, Response::HTTP_BAD_REQUEST);
            }

            $invoiceRequest = $form->getData();

            $InvoiceResponse = $this->invoiceCreateUseCase->execute($invoiceRequest);

            $presenter = $this->invoicePresenter->present($InvoiceResponse);

            $response = $this->InvoiceView->generate($presenter);

            return new JsonResponse($response->getSingleResult(), 200);
        } catch (Exception $exception) {
            return new JsonResponse(['error' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}