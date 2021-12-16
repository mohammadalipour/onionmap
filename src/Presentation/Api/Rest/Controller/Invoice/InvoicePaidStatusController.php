<?php

namespace App\Presentation\Api\Rest\Controller\Invoice;

use App\Core\Application\UseCase\Invoice\InvoicePaidStatusUseCase;
use App\Infrastructure\Framework\Form\FormRegistry;
use App\Infrastructure\Framework\Form\Type\Invoice\InvoicePaidStatusType;
use App\Presentation\Api\Rest\Controller\RestApiController;
use App\Presentation\Api\Rest\Presenter\Invoice\InvoicePaidPaidStatusPresenter;
use App\Presentation\Api\Rest\View\Invoice\InvoicePaidStatusView;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class InvoicePaidStatusController extends RestApiController
{
    private FormRegistry $formRegistry;
    private InvoicePaidPaidStatusPresenter $invoicePresenter;
    private InvoicePaidStatusUseCase $useCase;
    private InvoicePaidStatusView $InvoiceView;

    public function __construct(
        FormRegistry                   $formRegistry,
        InvoicePaidPaidStatusPresenter $invoicePresenter,
        InvoicePaidStatusUseCase       $useCase,
        InvoicePaidStatusView          $InvoiceView
    )
    {
        $this->formRegistry = $formRegistry;
        $this->invoicePresenter = $invoicePresenter;
        $this->useCase = $useCase;
        $this->InvoiceView = $InvoiceView;
    }

    public function __invoke(Request $request)
    {
        try {
            $form = $this->formRegistry->createForm(InvoicePaidStatusType::class);
            $form->handleRequest($request);
            $form->submit(json_decode($request->getContent(), true));

            if (!$form->isValid()) {
                return new JsonResponse($form, Response::HTTP_BAD_REQUEST);
            }

            $invoiceRequest = $form->getData();

            $InvoiceResponse = $this->useCase->execute($invoiceRequest);

            $presenter = $this->invoicePresenter->present($InvoiceResponse);

            $response = $this->InvoiceView->generate($presenter);

            return new JsonResponse($response->getSingleResult(), 200);
        } catch (Exception $exception) {
            return new JsonResponse(['error' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}