<?php

namespace Selene\CMSBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Selene\CMSBundle\Repository\BlogRepository;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class SeleneCMSExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $containerBuilder)
    {
        $loader = new YamlFileLoader(
            $containerBuilder,
            new FileLocator(__DIR__.'/../../config')
        );
        $loader->load('services.yml');
        $loader->load('routing.yml');
    }
}
