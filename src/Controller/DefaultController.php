<?php

namespace Selene\CMSBundle\Controller;

use Selene\CMSBundle\Traits\BlogSideBarTrait;
use Doctrine\Persistence\ManagerRegistry;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    // use BlogSideBarTrait;

    #[Route('/', name: 'default', options: ['sitemap' => ['priority' => 0.7, 'changefreq' => UrlConcrete::CHANGEFREQ_WEEKLY]])]
    public function index(ManagerRegistry $doctrine): Response
    {
        return $this->render('default/index.html.twig', [
            // 'blogs' => $this->getBlogList($doctrine),
        ]);
    }
}
