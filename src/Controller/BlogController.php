<?php

namespace Selene\CMSBlog\Controller;

use Selene\CMSBlog\Entity\Blog;
use Selene\CMSBlog\Traits\BlogSideBarTrait;
use Doctrine\Persistence\ManagerRegistry;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    use BlogSideBarTrait;

    #[Route('/blog', name: 'blog', options: ['sitemap' => ['priority' => 0.7, 'changefreq' => UrlConcrete::CHANGEFREQ_WEEKLY]])]
    public function index(ManagerRegistry $doctrine): Response
    {
        return $this->render('blog/index.html.twig', [
            'blogs' => $this->getBlogList($doctrine),
        ]);
    }

    #[Route('/blog/{slug}', name: 'blog_post')]
    public function article(#[MapEntity(mapping: ['slug' => 'slug'])] Blog $blog, ManagerRegistry $doctrine): Response
    {
        if (new \DateTime() > $blog->getDatePublished()) {
            return $this->render('blog/post.html.twig', [
            'blogs' => $this->getBlogList($doctrine),
            'blog' => $blog,
        ]);
        } else {
            return $this->redirectToRoute('blog');
        }
    }
}
