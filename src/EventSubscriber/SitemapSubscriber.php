<?php

namespace Selene\CMSBundle\EventSubscriber;

use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Presta\SitemapBundle\Service\UrlContainerInterface;
use Presta\SitemapBundle\Sitemap\Url\GoogleImage;
use Presta\SitemapBundle\Sitemap\Url\GoogleImageUrlDecorator;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Selene\CMSBundle\Repository\BlogRepository;
use Selene\CMSBundle\Repository\ImageFileRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SitemapSubscriber implements EventSubscriberInterface
{
    /**
     * @var BlogRepository
     */
    private $blogRepository;

    /**
     * @var ImageRepository
     */
    private $imageRepository;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    public function __construct(BlogRepository $blogRepository, ImageFileRepository $imageRepository, UrlGeneratorInterface $router)
    {
        $this->blogRepository = $blogRepository;
        $this->imageRepository = $imageRepository;
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
        $this->registerImageUrls($event->getUrlContainer());
    }

    public function registerImageUrls(UrlContainerInterface $urls): void
    {
        $images = $this->imageRepository->findAll();

        $protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
        $url = new UrlConcrete("{$protocol}{$_SERVER['SERVER_NAME']}");
        $decoratedUrl = new GoogleImageUrlDecorator($url);

        foreach ($images as $i) {
            $decoratedUrl->addImage(new GoogleImage($url->getLoc().$i->getImageFile()));
        }

        $urls->addUrl($decoratedUrl, 'images');
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
