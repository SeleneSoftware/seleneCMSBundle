<?php

namespace Selene\CMSBundle\Twig;

use Selene\CMSBundle\Handlers\BlogImageHandler;
use Selene\CMSBundle\Handlers\SettingsHandler;
use Selene\CMSBundle\Twig\Filter\ContentFilter;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    protected $settings;

    protected $blogImage;

    public function __construct(SettingsHandler $settings, BlogImageHandler $blogImage)
    {
        $this->settings = $settings;
        $this->blogImage = $blogImage;
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
        ];
    }

    // public function getTokenParsers()
    // {
        // return [new ContentParser()];
    // }
}
