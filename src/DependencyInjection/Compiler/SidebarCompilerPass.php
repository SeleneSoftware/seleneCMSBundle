<?php

namespace App\DependencyInjection\Compiler;

use App\Mail\TransportChain;
use Selene\CMSBundle\Sidebar\SidebarTransportChain;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class SidebarCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        // always first check if the primary service is defined
        if (!$container->has(SidebarTransportChain::class)) {
            return;
        }

        $definition = $container->findDefinition(SidebarTransportChain::class);

        // find all service IDs with the app.mail_transport tag
        $taggedServices = $container->findTaggedServiceIds('selene.sidebar');

        foreach ($taggedServices as $id => $tags) {
            // add the transport service to the TransportChain service
            $definition->addMethodCall('addTransport', [new Reference($id)]);
        }
    }
}
