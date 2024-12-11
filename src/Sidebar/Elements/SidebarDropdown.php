<?php

namespace Selene\CMSBundle\Sidebar\Elements;

class SidebarDropdown
{
    protected string $name;

    protected array $items = [];

    public function setName(string $name): self
    {
        $this->name = $name;
    }

    public function addItem(array $item): self
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
