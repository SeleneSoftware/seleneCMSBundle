<?php

namespace Selene\CMSBundle;

use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class seleneCMSBundle extends AbstractBundle
{
    public function loadExtension(array $config, ContainerConfigurator $containerConfigurator, ContainerBuilder $containerBuilder): void
    {
        // load an XML, PHP or Yaml file
        $containerConfigurator->import('../config/routing.yml');

        // you can also add or replace parameters and services
        // $containerConfigurator->parameters()
        //                       ->set('acme_hello.phrase', $config['phrase'])
        // ;
        //
        // if ($config['scream']) {
        //     $containerConfigurator->services()
        //                           ->get('acme_hello.printer')
        //                           ->class(ScreamingPrinter::class)
        //     ;
        // }
    }
}
