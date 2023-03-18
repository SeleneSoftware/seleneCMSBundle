<?php

namespace Selene\CMSBundle\Controller;

use Selene\CMSBundle\Entity\Blog;
use Selene\CMSBundle\Traits\BlogTrait;
use Doctrine\Persistence\ManagerRegistry;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    use BlogTrait;

    #[Route('/blog', name: 'selene_cms_blog', options: ['sitemap' => ['priority' => 0.7, 'changefreq' => UrlConcrete::CHANGEFREQ_WEEKLY]])]
    public function blogList(ManagerRegistry $doctrine): Response
    {
        return $this->render('blog/index.html.twig', [
            'blogs' => $this->getBlogList($doctrine),
        ]);
    }

    #[Route('/blog/{slug}', name: 'selene_cms_blog_post')]
    public function blogArticle(#[MapEntity(mapping: ['slug' => 'slug'])] Blog $blog, ManagerRegistry $doctrine): Response
    {
        if (new \DateTime() > $blog->getDatePublished()) {
            return $this->render('blog/post.html.twig', [
            'blogs' => $this->getBlogList($doctrine, 3),
            'blog' => $blog,
        ]);
        } else {
            return $this->redirectToRoute('selene_cms_blog');
        }
    }
}
