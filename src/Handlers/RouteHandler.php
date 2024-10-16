<?php

namespace Selene\CMSBundle\Handlers;

use Selene\CMSBundle\Twig\Filter\ContentFilter;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RouteHandler
{
    public function __construct(
        protected ContentFilter $filter,
        private UrlGeneratorInterface $router,
    ) {
    }

    // This is used to determine if a string is a full domain route or a Symfony route
    public function getRoute(string $routeName = '#', array $routeParameters = [])
    {
        try {
            $url = $this->router->generate($routeName, $routeParameters);
        } catch (RouteNotFoundException $e) {
            $url = $routeName;
        }

        return $url;
    }
}
