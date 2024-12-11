<?php

namespace Selene\CMSBundle\Sidebar;

use Selene\CMSBundle\Interfaces\SidebarInterface;

class SidebarDefault implements SidebarInterface
{
    protected $itemList = [];

    public function build()
    {
        $this->itemList = [
            (new Elements\SidebarDropdown())
                ->setName('Site')
                ->addItem(new Elements\SidebarItem('Settings', 'selene_cms_settings'))
                ->addItem(new Elements\SidebarItem('Content', 'selene_cms_settings'))
                ->addItem(new Elements\SidebarItem('Images', 'selene_cms_settings')),
            new Elements\SidebarItem('Blog', 'selene_cms_settings'),
            (new Elements\SidebarDropdown())
                ->setName('Account'),
            new Elements\SidebarItem('View Site', 'app_default'),
        ];
    }

    public function getList(): array
    {
        return $this->itemList;
    }
}
