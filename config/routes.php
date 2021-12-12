<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use App\Presentation\Api\Rest\Controller\Company\CreateCompanyController;

return static function (RoutingConfigurator $routes) {
    $routes->add('create_company', 'company')
        ->controller(CreateCompanyController::class)
        ->methods(['POST']);
};