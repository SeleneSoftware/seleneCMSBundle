<?php

namespace Selene\CMSBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class SidebarCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        // Check if the tagged services are defined
        if (!$container->has('app.custom_service_collector')) {
            return;
        }

        $definition = $container->findDefinition('app.custom_service_collector');

        // Find all services tagged with 'app.custom_tag'
        $taggedServices = $container->findTaggedServiceIds('seleneCMS.sidebar');

        foreach ($taggedServices as $id => $tags) {
            // Add tagged services to the collector
            $definition->addMethodCall('addService', [new Reference($id)]);
        }
    }
}
