<?php

namespace App\Presentation\Api\Rest\Controller\Invoice;

use App\Core\Application\UseCase\Invoice\CreateInvoiceUseCase;
use App\Infrastructure\Framework\Form\FormRegistry;
use App\Infrastructure\Framework\Form\Type\Invoice\CreateInvoiceType;
use App\Presentation\Api\Rest\Presenter\Invoice\CreateInvoicePresenter;
use App\Presentation\Api\Rest\View\Invoice\CreateInvoiceView;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CreateInvoiceController extends AbstractFOSRestController
{
    private FormRegistry $formRegistry;
    private CreateInvoicePresenter $invoicePresenter;
    private CreateInvoiceUseCase $createUseCase;
    private CreateInvoiceView $InvoiceView;

    public function __construct(
        FormRegistry           $formRegistry,
        CreateInvoicePresenter $invoicePresenter,
        CreateInvoiceUseCase   $createUseCase,
        CreateInvoiceView      $InvoiceView
    )
    {
        $this->formRegistry = $formRegistry;
        $this->invoicePresenter = $invoicePresenter;
        $this->createUseCase = $createUseCase;
        $this->InvoiceView = $InvoiceView;
    }

    public function __invoke(Request $request)
    {
        try {
            $form = $this->formRegistry->createForm(CreateInvoiceType::class);
            $form->handleRequest($request);
            $form->submit(json_decode($request->getContent(), true));

            if (!$form->isValid()) {
                return new JsonResponse($form, Response::HTTP_BAD_REQUEST);
            }

            $invoiceRequest = $form->getData();

            $InvoiceResponse = $this->createUseCase->execute($invoiceRequest);

            $presenter = $this->invoicePresenter->present($InvoiceResponse);

            $response = $this->InvoiceView->generate($presenter);

            return new JsonResponse($response->getSingleResult(), 200);
        } catch (Exception $exception) {
            return new JsonResponse(['error'=>$exception->getMessage()],Response::HTTP_BAD_REQUEST);
        }
    }
}