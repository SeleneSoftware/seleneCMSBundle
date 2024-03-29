<?php

namespace Selene\CMSBundle\Traits;

use Doctrine\ORM\EntityManagerInterface;
use Selene\CMSBundle\Entity\Blog;

trait BlogTrait
{
    public function getBlogList(EntityManagerInterface $doctrine, $entries = null): array
    {
        $loop = 0;
        foreach ($blogs = $doctrine->getRepository(Blog::class)->findAll() as $k => $b) {
            // Don't show any that are to be published in the future
            if (new \DateTime() < $b->getDatePublished()) {
                unset($blogs[$k]);
            }
        }

        // If we only need a few of them, only show a few of them.  Default is all
        if ($entries) {
            return array_slice($blogs, 0, $entries);
        }

        return $blogs;
    }
}
