<?php

namespace Selene\CMSBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class InstanceOfExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('instanceof', [$this, 'isInstanceOf']),
        ];
    }

    public function isInstanceOf($object, string $class): bool
    {
        return $object instanceof $class;
    }
}
