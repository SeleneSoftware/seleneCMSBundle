<?php

namespace Selene\Twig\Filter;

use Selene\Entity\Content;
use Doctrine\Persistence\ManagerRegistry;
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
}
