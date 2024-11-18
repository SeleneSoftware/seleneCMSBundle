<?php

namespace Selene\CMSBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SettingsController extends AbstractController
{
    #[Route('/admin/settings', name: 'selene_cms_settings')]
    public function adminIndex(): Response
    {
        return $this->render('@seleneCMS/admin/settings.html.twig', [
        ]);
    }
}
