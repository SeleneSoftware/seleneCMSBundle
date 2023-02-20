<?php

namespace Selene\CMSBlog\Interfaces;

interface BoolEntityInterface
{
    public function getValue(): ?bool;

    public function setValue(?bool $value): self;
}
