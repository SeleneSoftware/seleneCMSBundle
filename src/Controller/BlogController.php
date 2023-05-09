<?php

namespace Selene\CMSBundle\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Selene\CMSBundle\Entity\Blog;
use Selene\CMSBundle\Entity\Comment;
use Selene\CMSBundle\Form\CommentType;
use Selene\CMSBundle\Traits\BlogTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function blogArticle(#[MapEntity(mapping: ['slug' => 'slug'])] Blog $blog, ManagerRegistry $doctrine, Request $request): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setAuthor($this->gerUser())
                ->setBlog($blog);
            $em = $doctrine->getEntityManager();
            $em->persist($comment);
            $em->flush();
        }

        if (new \DateTime() > $blog->getDatePublished()) {
            return $this->render('blog/post.html.twig', [
            'blogs' => $this->getBlogList($doctrine, 3),
            'blog' => $blog,
            'commentForm' => $form->createView(),
        ]);
        } else {
            return $this->redirectToRoute('selene_cms_blog');
        }
    }
}
