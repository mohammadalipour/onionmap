<?php

namespace App\Infrastructure\Framework;

use App\Infrastructure\Framework\DependencyInjection\Compiler\EntityRepositoryCompilerPass;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

final class Kernel extends BaseKernel
{

    use MicroKernelTrait;

    protected function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new EntityRepositoryCompilerPass());
    }

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import('../../../config/{packages}/*.yaml');
        $container->import('../../../config/{packages}/'.$this->environment.'/*.yaml');

        if (is_file($path = \dirname(__DIR__).'/../../config/services.php')) {
            (require $path)($container->withPath($path), $this);
        }
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import('../../../config/{routes}/'.$this->environment.'/*.yaml');
        $routes->import('../../../config/{routes}/*.yaml');

        if (is_file($path = \dirname(__DIR__).'/../../config/routes.php')) {
            (require $path)($routes->withPath($path), $this);
        }
    }
}
