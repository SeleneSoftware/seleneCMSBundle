<?php

namespace Selene\CMSBundle\Traits;

use Doctrine\Persistence\ManagerRegistry;
use Selene\CMSBundle\Entity\Blog;

trait BlogTrait
{
    public function getBlogList(ManagerRegistry $doctrine, $entries = null): array
    {
        $loop = 0;
        foreach ($blogs = $doctrine->getRepository(Blog::class)->findAll() as $k => $b) {
            // Don't show private entires
            // Not yet, either
            // if ($b->getPrivate()) {
            //     unset($blogs[$k]);
            //     continue;
            // }

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
