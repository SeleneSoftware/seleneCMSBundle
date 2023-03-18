<?php

namespace Selene\CMSBundle\Traits;

use Selene\CMSBundle\Entity\Blog;
use Doctrine\Persistence\ManagerRegistry;

trait BlogTrait
{
    public function getBlogList(ManagerRegistry $doctrine, $entries = null): array
    {
        $loop = 0;
        foreach ($blogs = $doctrine->getRepository(Blog::class)->findAll() as $k => $b) {
            // Don't show private entires
            if ($b->getPrivate()) {
                unset($blogs[$k]);
                continue;
            }
            // If we only need a few of them, only show a few of them.  Default is all
            if ($entries) {
                if ($loop <= $entries) {
                    break;
                }
                $loop++;
            }

            // Don't show any that are to be published in the future
            if (new \DateTime() < $b->getDatePublished()) {
                unset($blogs[$k]);
            }
        }

        return array_reverse($blogs);
    }
}
