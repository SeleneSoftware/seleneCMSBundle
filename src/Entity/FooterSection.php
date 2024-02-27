<?php

namespace Selene\CMSBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Selene\CMSBundle\Repository\FooterSectionRepository;

#[ORM\Entity(repositoryClass: FooterSectionRepository::class)]
class FooterSection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'footerSection', targetEntity: Footer::class)]
    private Collection $entry;

    public function __construct()
    {
        $this->entry = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Footer>
     */
    public function getEntry(): Collection
    {
        return $this->entry;
    }

    public function addEntry(Footer $entry): static
    {
        if (!$this->entry->contains($entry)) {
            $this->entry->add($entry);
            $entry->setFooterSection($this);
        }

        return $this;
    }

    public function removeEntry(Footer $entry): static
    {
        if ($this->entry->removeElement($entry)) {
            // set the owning side to null (unless already changed)
            if ($entry->getFooterSection() === $this) {
                $entry->setFooterSection(null);
            }
        }

        return $this;
    }
}
