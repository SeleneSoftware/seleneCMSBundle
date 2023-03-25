<?php

namespace Selene\CMSBundle\Entity;

use Selene\CMSBundle\Repository\ImageFileRepository;
use Doctrine\ORM\Mapping as ORM;
use Selene\CMSBundle\Interfaces\ImageEntityInterface;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: ImageFileRepository::class)]
class ImageFile implements ImageEntityInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $file = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }
}
