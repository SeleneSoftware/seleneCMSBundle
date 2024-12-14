<?php

namespace Selene\CMSBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/admin/blog', name: 'selene_cms_admin_blog')]
    public function adminBlogIndex(): Response
    {
        return $this->render('@seleneCMS/admin/dashboard.html.twig', [
        ]);
    }
}
