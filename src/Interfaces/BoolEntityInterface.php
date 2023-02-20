<?php

namespace Selene\Interfaces;

interface BoolEntityInterface
{
    public function getValue(): ?bool;

    public function setValue(?bool $value): self;
}
