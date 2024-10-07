<?php

namespace Selene\CMSBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Selene\CMSBundle\Entity\Blog;
use Selene\CMSBundle\Entity\Comment;
use Selene\CMSBundle\Form\CommentType;
use Selene\CMSBundle\Traits\BlogTrait;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    use BlogTrait;

    #[Route('/blog', name: 'selene_cms_blog', options: ['sitemap' => ['priority' => 0.7, 'changefreq' => UrlConcrete::CHANGEFREQ_WEEKLY]])]
    public function blogList(EntityManagerInterface $doctrine): Response
    {
        return $this->render('blog/index.html.twig', [
            'blogs' => $this->getBlogList($doctrine),
        ]);
    }

    #[Route('/blog/{slug}', name: 'selene_cms_blog_post')]
    public function blogArticle(
        #[MapEntity(expr: 'repository.findOneBySlug(slug)')]
        Blog $blog,
        EntityManagerInterface $doctrine,
        Request $request
    ): Response {

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setAuthor($this->getUser())
                    ->setBlog($blog);
            $doctrine->persist($comment);
            $doctrine->flush();

            unset($form);
            unset($comment);
            $comment = new Comment();
            $form = $this->createForm(CommentType::class, $comment);
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
