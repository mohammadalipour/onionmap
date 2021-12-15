<?php

namespace App\Presentation\Api\Rest\Controller\Company;

use App\Core\Application\UseCase\Company\CreateCompanyUseCase;
use App\Infrastructure\Framework\Form\FormRegistry;
use App\Infrastructure\Framework\Form\Type\Company\CreateCompanyType;
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
    private CreateCompanyUseCase $createUseCase;
    private CreateCompanyView $companyView;

    public function __construct(
        FormRegistry           $formRegistry,
        CreateCompanyPresenter $companyPresenter,
        CreateCompanyUseCase   $createUseCase,
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
        try {
            $form = $this->formRegistry->createForm(CreateCompanyType::class);
            $form->handleRequest($request);
            $form->submit(json_decode($request->getContent(), true));

            if (!$form->isValid()) {

                dd($form->getErrors(true));
                return new JsonResponse($form->getErrors(true,false), Response::HTTP_BAD_REQUEST);
            }

            $companyRequest = $form->getData();
            $companyResponse = $this->createUseCase->execute($companyRequest);

            $presenter = $this->companyPresenter->present($companyResponse);

            $response = $this->companyView->generate($presenter);

            return new JsonResponse($response->getSingleResult(),200);
        }catch (\Exception $exception){

        }
    }
}