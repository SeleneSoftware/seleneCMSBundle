<?php

namespace Selene\CMSBundle\Twig\Filter;

use Doctrine\Persistence\ManagerRegistry;
use Selene\CMSBundle\Entity\Content;
use Selene\CMSBundle\Entity\ImageFile;
use Twig\Extension\RuntimeExtensionInterface;

class ContentFilter implements RuntimeExtensionInterface
{
    protected $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getContent($name, $content): string
    {
        $entityManager = $this->doctrine->getManager();
        $repo = $entityManager->getRepository(Content::class);
        $stuff = $repo->findOneBy(['name' => $name]);

        if (null == $stuff) {
            $stuff = new Content();
            $stuff->setName($name)
                  ->setType('content')
                  ->setValue($content)
            ;
            $repo->add($stuff, true);

            return $content;
        }

        return $stuff->getValue();
    }

    public function getImage($slug, $content): string
    {
        $entityManager = $this->doctrine->getManager();
        $repo = $entityManager->getRepository(ImageFile::class);
        $stuff = $repo->findOneBy(['slug' => $slug]);

        if (null == $stuff) {
            return $content;
        }

        return $stuff->getImageFile();
    }
}
