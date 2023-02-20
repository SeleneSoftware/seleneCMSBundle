<?php

namespace App\Twig\Filter;

use Doctrine\Persistence\ManagerRegistry;
use Twig\Extension\RuntimeExtensionInterface;

class SettingsFilter implements RuntimeExtensionInterface
{
    protected $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getSetting($name, $default)
    {
    }
}
