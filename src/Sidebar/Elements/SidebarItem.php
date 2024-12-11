<?php

namespace Selene\CMSBundle\Sidebar\Elements;

class SitebarItem
{
    protected $name;

    protected $path;

    public function __construct(?string $name = null, ?string $path = null)
    {
        $this->name = $name;
        $this->path = $path;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
    }

    public function setPath(string $path): self
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
