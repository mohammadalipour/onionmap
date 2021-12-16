<?php

use App\Presentation\Api\Rest\Controller\Invoice\InvoiceCreateController;
use App\Presentation\Api\Rest\Controller\Invoice\InvoicePaidStatusController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use App\Presentation\Api\Rest\Controller\Company\CompanyCreateController;

return static function (RoutingConfigurator $routes) {
    //company
    $routes->add('create_company', 'company')
        ->controller(CompanyCreateController::class)
        ->methods(['POST']);

    //invoice
    $routes->add('create_invoice', 'invoice')
        ->controller(InvoiceCreateController::class)
        ->methods(['POST']);
    $routes->add('invoice_paid_status', 'invoice/paid')
        ->controller(InvoicePaidStatusController::class)
        ->methods(['PUT']);
};