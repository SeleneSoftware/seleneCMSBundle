<?php

namespace Selene\CMSBundle\Sidebar\Elements;

class SidebarDropdown
{
    protected string $name;

    protected array $items = [];

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function addItem(array $item)
    {
        $this->items[] = $item;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getItems(): array
    {
        return $this->items;
    }
}
