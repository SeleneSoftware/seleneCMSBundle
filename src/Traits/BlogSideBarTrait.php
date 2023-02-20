<?php

namespace Selene\CMSBlog\Traits;

use Selene\CMSBlog\Entity\Blog;
use Doctrine\Persistence\ManagerRegistry;

trait BlogSideBarTrait
{
    public function getBlogList(ManagerRegistry $doctrine): array
    {
        foreach ($blogs = $doctrine->getRepository(Blog::class)->findAll() as $k => $b) {
            if (new \DateTime() < $b->getDatePublished()) {
                unset($blogs[$k]);
            }
        }

        return array_reverse($blogs);
    }
}
