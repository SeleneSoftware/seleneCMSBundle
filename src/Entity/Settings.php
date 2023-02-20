<?php

namespace Selene\CMSBundle\Entity;

use Selene\CMSBundle\Interfaces\BoolEntityInterface;
use Selene\CMSBundle\Repository\SettingsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SettingsRepository::class)]
class Settings implements BoolEntityInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $value = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getValue(): ?bool
    {
        return $this->value;
    }

    public function setValue(?bool $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function isStuff(): ?bool
    {
        return $this->stuff;
    }

    public function setStuff(bool $stuff): self
    {
        $this->stuff = $stuff;

        return $this;
    }
}
