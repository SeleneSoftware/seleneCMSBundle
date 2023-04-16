<?php

namespace Selene\CMSBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class seleneCMSBundle extends AbstractBundle
{
    public function loadExtension(array $config, ContainerConfigurator $containerConfigurator, ContainerBuilder $containerBuilder): void
    {
        //     // load an XML, PHP or Yaml file
        $containerConfigurator->import('../config/services.yml');
        $containerConfigurator->import('../config/routing.yml');
    }
}
