<?php

namespace Selene\CMSBundle\Sidebar;

use Selene\CMSBundle\Elements;
use Selene\CMSBundle\Interfaces\SidebarInterface;

class SidebarDefault implements SidebarInterface
{
    protected $itemList = [];

    public function build()
    {
        $this->itemList = [
            (new Elements\SidebarDropdown())
                ->setName('Site')
                ->addItem(new Elements\SidebarItem('Settings', 'selene_cms_settings')),
            new Elements\SidebarItem('Blog', 'selenecms_settings'),
        ];
    }

    public function getList(): array
    {
        return $this->itemList;
    }
}
