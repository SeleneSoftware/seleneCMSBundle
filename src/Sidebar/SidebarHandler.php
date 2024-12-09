<?php

namespace Selene\CMSBundle\Sidebar;

use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

class SidebarHandler
{
    public function __construct(
        // the attribute must be applied directly to the argument to autowire
        #[AutowireIterator('selene.sidebar')]
        iterable $sidebar
    ) {
        dd($handler);
    }

    public function getSidebarArray(): array
    {
        return [];
    }
}
