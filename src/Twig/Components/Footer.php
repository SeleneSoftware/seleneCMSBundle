<?php

namespace Selene\CMSBundle\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Selene\CMSBundle\Repository\FooterSectionRepository;

// use Doctrine\Common\Collections\ArrayCollection;

#[AsTwigComponent]
final class Footer
{
    private array $data;

    public function __construct(
        private FooterSectionRepository $repo,
    ) {
    }

    public function mount()
    {
        $this->data = $this->repo->findAll();
    }
}
