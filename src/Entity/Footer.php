<?php

namespace Selene\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Selene\CMSBundle\Repository\FooterRepository;

#[ORM\Entity(repositoryClass: FooterRepository::class)]
class Footer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $route = null;

    #[ORM\ManyToOne(inversedBy: 'product')]
    private ?FooterSection $footerSection = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getRoute(): ?string
    {
        return $this->route;
    }

    public function setRoute(string $route): static
    {
        $this->route = $route;

        return $this;
    }

    public function getFooterSection(): ?FooterSection
    {
        return $this->footerSection;
    }

    public function setFooterSection(?FooterSection $footerSection): static
    {
        $this->footerSection = $footerSection;

        return $this;
    }
}
