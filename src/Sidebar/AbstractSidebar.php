<?php

namespace Selene\CMSBundle\Sidebar;

abstract class AbstractSidebar implements SidebarInterface
{
    protected $sidebarList = [];

    abstract public function build();

    public function getList(): array
    {
        return $this->sidebarList;
    }
}
