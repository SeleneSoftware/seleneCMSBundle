<?php

namespace App\Interfaces;

interface BoolEntityInterface
{
    public function getValue(): ?bool;

    public function setValue(?bool $value): self;
}
