<?php

namespace Selene\CMSBundle\Tools;

use Selene\CMSBundle\Service\SidebarInterface;

class Sidebar implements SidebarInterface
{
    public function addItem(string $category, string $name, string $path)
    {
    }

    public function getList(): array
    {
        return SidebarInterface::default_list;
    }
}
