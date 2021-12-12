<?php

namespace App\Presentation\Api\Rest\Controller\Company;

use App\Core\Application\UseCase\Company\CreateUseCase;
use App\Infrastructure\Framework\Form\FormRegistry;
use App\Infrastructure\Framework\Form\Type\Company\CreateType;
use App\Presentation\Api\Rest\Presenter\Company\CreateCompanyPresenter;
use App\Presentation\Api\Rest\View\Company\CreateCompanyView;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CreateCompanyController extends AbstractFOSRestController
{
    private FormRegistry $formRegistry;
    private CreateCompanyPresenter $companyPresenter;
    private CreateUseCase $createUseCase;
    private CreateCompanyView $companyView;

    public function __construct(
        FormRegistry           $formRegistry,
        CreateCompanyPresenter $companyPresenter,
        CreateUseCase          $createUseCase,
        CreateCompanyView      $companyView
    )
    {
        $this->formRegistry = $formRegistry;
        $this->companyPresenter = $companyPresenter;
        $this->createUseCase = $createUseCase;
        $this->companyView = $companyView;
    }

    public function __invoke(Request $request)
    {
        $form = $this->formRegistry->createForm(CreateType::class);
        $form->handleRequest($request);
        $form->submit(json_decode($request->getContent(), true));

        if (!$form->isValid()) {
            return new JsonResponse($form->getErrors(), Response::HTTP_BAD_REQUEST);
        }

        $companyRequest = $form->getData();
        $companyResponse = $this->createUseCase->execute($companyRequest);

        $presenter = $this->companyPresenter->present($companyResponse);

        $response = $this->companyView->generate($presenter);

        return new JsonResponse($response->getSingleResult(),200);
    }
}