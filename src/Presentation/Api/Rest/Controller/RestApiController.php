<?php

namespace App\Presentation\Api\Rest\Controller;

use App\Infrastructure\Transfer\ResultCollection;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class RestApiController extends AbstractFOSRestController
{
    /**
     * @param ResultCollection $collection
     * @param int $statusCode
     * @return JsonResponse
     */
    public function successResponse(ResultCollection $collection, int $statusCode = Response::HTTP_OK): JsonResponse
    {
        return new JsonResponse(
            [
                'status_code' => $statusCode,
                'status' => 'success',
                'data' => $collection->getSingleResult()
            ]
        );
    }

    /**
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public function failResponse(string $message, int $statusCode): JsonResponse
    {
        return new JsonResponse(
            [
                'status_code' => $statusCode,
                'status' => 'failed',
                'message' => $message
            ]
        );
    }
}