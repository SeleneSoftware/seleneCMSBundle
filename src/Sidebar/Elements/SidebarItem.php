<?php

namespace Selene\CMSBundle\Sidebar\Elements;

class SitebarItem
{
    protected $name;

    protected $path;

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setPath(string $path)
    {
        $this->path = $path;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPath(): string
    {
        return $this->path;
    }
}
