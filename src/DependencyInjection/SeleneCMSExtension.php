<?php

namespace Selene\CMSBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

class SeleneCMSExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $containerBuilder)
    {
        // ... you'll load the files here later
        //

        $this->addAnnotatedClassesToCompile([
            // you can define the fully qualified class names...
            'Selene\CMSBundle\\Controller\\**',
            //                 // ... but glob patterns are also supported:
            // '**Bundle\\Controller\\',
            //
            //                                 // ...
            //                                     ]);'
        ]);
    }
}
