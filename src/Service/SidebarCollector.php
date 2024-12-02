<?php

namespace Selene\CMSBundle\Service;

class SidebarCollector
{
    private $services = [];

    public function addService($service)
    {
        $this->services[] = $service;
    }

    public function getServices(): array
    {
        return $this->services;
    }
}
