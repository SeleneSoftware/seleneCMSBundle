<?php

namespace Selene\CMSBundle\Twig;

use Selene\CMSBundle\Handlers\BlogImageHandler;
use Selene\CMSBundle\Handlers\RouteHandler;
use Selene\CMSBundle\Handlers\SettingsHandler;
use Selene\CMSBundle\Traits\BlogTrait;
use Selene\CMSBundle\Twig\Filter\ContentFilter;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    use BlogTrait;

    public function __construct(
        protected SettingsHandler $settings,
        protected BlogImageHandler $blogImage,
        protected RouteHandler $router
    ) {
        $this->settings = $settings;
        $this->blogImage = $blogImage;
        $this->routeHandler = $router;
    }

    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
            new TwigFilter('*_content', [ContentFilter::class, 'getContent'], ['is_safe' => ['html']]),
            new TwigFilter('*_image', [ContentFilter::class, 'getImage'], ['is_safe' => ['html']]),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('getSetting', [$this->settings, 'getSetting']),
            new TwigFunction('getBlogImage', [$this->blogImage, 'getBlogImage']),
            new TwigFunction('route', [$this->routeHandler, 'getRoute']),
        ];
    }

    public function getGlobals(): array
    {
        return [
            'recentBlogs' => array_reverse($this->getBlogList($doctrine, 6)),
        ];
    }

    // public function getTokenParsers()
    // {
    // return [new ContentParser()];
    // }
}
