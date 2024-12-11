<?php

namespace Selene\CMSBundle\Sidebar;

use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

class SidebarHandler
{
    public function __construct(
        // the attribute must be applied directly to the argument to autowire
        #[AutowireIterator('selene.sidebar')]
        protected iterable $sidebar
    ) {
    }

    public function getSidebarArray(): array
    {
        $sidebarList = [];
        foreach ($this->sidebar as $s) {
            $s->build();
            $sidebarList = array_merge($sidebarList, $s->getList());
        }

        return array_unique($sidebarList);
    }
}
