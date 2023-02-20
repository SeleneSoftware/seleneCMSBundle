<?php

namespace Selene\CMSBundle\Interfaces;

interface BoolEntityInterface
{
    public function getValue(): ?bool;

    public function setValue(?bool $value): self;
}
