<?php

namespace Selene\CMSBundle;

use Selene\CMSBundle\DependencyInjection\SeleneCMSExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class seleneCMSBundle extends AbstractBundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        // Return the custom extension
        if (null === $this->extension) {
            $this->extension = new SeleneCMSExtension();
        }

        return $this->extension;
    }
    // public function loadExtension(array $config, ContainerConfigurator $containerConfigurator, ContainerBuilder $containerBuilder): void
    // {
    //     //     // load an XML, PHP or Yaml file
    //     $containerConfigurator->import('../config/services.yml');
    //     $containerConfigurator->import('../config/routing.yml');
    // }

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

    // public function getAlias(): string
    // {
    //     // Return the alias name
    //     return 'selenecms';
    // }
}
