<?php

namespace Selene\CMSBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/admin', name: 'selene_cms_admin')]
    public function adminIndex(): Response
    {
        return $this->render('@seleneCMS/admin/dashboard.html.twig', [
        ]);
    }

    #[Route('/admin/settings', name: 'selene_cms_settings')]
    public function adminSettingsIndex(): Response
    {
        return $this->render('@seleneCMS/admin/settings.html.twig', [
        ]);
    }
}
