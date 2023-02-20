<?php

namespace App\Twig;

use App\Handlers\SettingsHandler;
use App\Twig\Filter\ContentFilter;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    protected $settings;

    public function __construct(SettingsHandler $settings)
    {
        $this->settings = $settings;
    }

    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
            new TwigFilter('*_content', [ContentFilter::class, 'getContent'], ['is_safe' => ['html']]),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('getSetting', [$this->settings, 'getSetting']),
        ];
    }

    // public function getTokenParsers()
    // {
        // return [new ContentParser()];
    // }
}
