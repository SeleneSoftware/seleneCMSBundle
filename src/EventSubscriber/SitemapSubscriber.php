<?php

namespace Selene\CMSBundle\EventSubscriber;

use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Presta\SitemapBundle\Service\UrlContainerInterface;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Selene\CMSBundle\Repository\BlogRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SitemapSubscriber implements EventSubscriberInterface
{
    /**
     * @var BlogRepository
     */
    private $blogRepository;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    public function __construct(BlogRepository $blogRepository, UrlGeneratorInterface $router)
    {
        $this->blogRepository = $blogRepository;
        $this->router = $router;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [
            SitemapPopulateEvent::class => 'populate',
        ];
    }

    public function populate(SitemapPopulateEvent $event): void
    {
        $this->registerBlogPostsUrls($event->getUrlContainer());
    }

    public function registerBlogPostsUrls(UrlContainerInterface $urls): void
    {
        $posts = $this->blogRepository->findAll();

        foreach ($posts as $post) {
            if (new \DateTime() < $post->getDatePublished()) {
                continue;
            }
            $urls->addUrl(
                new UrlConcrete(
                    $this->router->generate(
                        'selene_cms_blog_post',
                        ['slug' => $post->getSlug()],
                        UrlGeneratorInterface::ABSOLUTE_URL
                    )
                ),
                'blog'
            );
        }
    }
}
