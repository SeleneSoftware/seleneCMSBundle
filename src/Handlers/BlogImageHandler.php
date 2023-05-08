<?php

namespace Selene\CMSBundle\Handlers;

use Doctrine\Persistence\ManagerRegistry;
use Selene\CMSBundle\Entity\Blog;
use Selene\CMSBundle\Twig\Filter\ContentFilter;

class BlogImageHandler
{
    protected $doctrine;

    protected $filter;

    public function __construct(ManagerRegistry $doctrine, ContentFilter $filter)
    {
        $this->doctrine = $doctrine;
        $this->filter = $filter;
    }

    public function getBlogImage(Blog $blog)
    {
        return $this->filter->getImage($blog->getImageFile()->getSlug(), '');
    }
}
