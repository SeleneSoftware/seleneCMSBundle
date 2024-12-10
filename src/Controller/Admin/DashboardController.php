<?php

namespace Selene\CMSBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    protected $sidebar = [
        'Site' => [
            'Settings' => 'selene_cms_settings',
            'Content' => 'selene_cms_settings',
            'Images' => 'selene_cms_settings',
        ],
        'Blog' => 'selene_cms_admin',
        'Account' => [],
        'View Site' => 'app_default',
    ];

    protected function addSidebarItem(string $category, string $item, string $path)
    {
        if (isset($this->sidebar[$category][$item])) {
            throw new SidebarExistsException();
        }
        $this->sidebar[$category][$item] = $path;

        return;
    }

    #[Route('/admin', name: 'selene_cms_admin')]
    public function adminIndex(): Response
    {
        return $this->render('@seleneCMS/admin/dashboard.html.twig', [
            'sidebar' => $this->sidebar,
        ]);
    }

    #[Route('/admin/settings', name: 'selene_cms_settings')]
    public function adminSettingsIndex(): Response
    {
        return $this->render('@seleneCMS/admin/settings.html.twig', [
        ]);
    }
}
