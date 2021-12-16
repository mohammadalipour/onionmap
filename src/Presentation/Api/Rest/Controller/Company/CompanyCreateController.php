<?php

namespace App\Presentation\Api\Rest\Controller\Company;

use App\Core\Application\UseCase\Company\CompanyCreateUseCase;
use App\Infrastructure\Framework\Form\FormRegistry;
use App\Infrastructure\Framework\Form\Type\Company\CompanyCreateType;
use App\Presentation\Api\Rest\Controller\RestApiController;
use App\Presentation\Api\Rest\Presenter\Company\CompanyCreatePresenter;
use App\Presentation\Api\Rest\View\Company\CompanyCreateView;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CompanyCreateController extends RestApiController
{
    private FormRegistry $formRegistry;
    private CompanyCreatePresenter $companyPresenter;
    private CompanyCreateUseCase $companyCreateUseCase;
    private CompanyCreateView $companyView;

    public function __construct(
        FormRegistry           $formRegistry,
        CompanyCreatePresenter $companyPresenter,
        CompanyCreateUseCase   $createUseCase,
        CompanyCreateView      $companyView
    )
    {
        $this->formRegistry = $formRegistry;
        $this->companyPresenter = $companyPresenter;
        $this->companyCreateUseCase = $createUseCase;
        $this->companyView = $companyView;
    }

    public function __invoke(Request $request)
    {
        try {
            $form = $this->formRegistry->createForm(CompanyCreateType::class);
            $form->handleRequest($request);
            $form->submit(json_decode($request->getContent(), true));

            if (!$form->isValid()) {
                return new JsonResponse($form->getErrors(true, false), Response::HTTP_BAD_REQUEST);
            }

            $companyRequest = $form->getData();

            $companyResponse = $this->companyCreateUseCase->execute($companyRequest);
            $companyPresenter = $this->companyPresenter->present($companyResponse);
            $companyResponse = $this->companyView->generate($companyPresenter);

            return new JsonResponse($companyResponse->getSingleResult(), 200);
        } catch (Exception $exception) {

        }
    }
}