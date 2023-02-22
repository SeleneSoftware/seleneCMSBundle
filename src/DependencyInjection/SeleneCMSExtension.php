<?php

namespace Selene\CMSBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;

class SeleneCMSExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $containerBuilder)
    {
        $containerBuilder->registerForAutoconfiguration(ServiceEntityRepositoryInterface::class)
                        ->addTag('doctrine.repository_service')
        ;

        $this->addAnnotatedClassesToCompile([
            // you can define the fully qualified class names...
            'Selene\CMSBundle\\Controller\\**',
        ]);
    }
}
