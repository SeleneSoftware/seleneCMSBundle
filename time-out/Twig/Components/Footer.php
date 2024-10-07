<?php

namespace Selene\CMSBundle\Twig\Components;

use Selene\CMSBundle\Repository\FooterSectionRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

// use Doctrine\Common\Collections\ArrayCollection;

#[AsTwigComponent]
final class Footer
{
    public array $data;

    public function __construct(
        private FooterSectionRepository $repo,
    ) {
    }

    public function mount()
    {
        $this->data = $this->repo->findAll();
    }
}
