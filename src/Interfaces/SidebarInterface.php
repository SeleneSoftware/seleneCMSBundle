<?php

namespace Selene\CMSBundle\Interfaces;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('selene.sidebar')]
interface SidebarInterface
{
    public const DEFAULTLIST = [
        'Site' => [
            'Settings' => 'selene_cms_settings',
            'Content' => 'selene_cms_settings',
            'Images' => 'selene_cms_settings',
        ],
        'Blog' => 'selene_cms_admin',
        'Account' => [
        ],
        'View Site' => 'app_default',
    ];

    public function build();

    public function getList(): array;
}
