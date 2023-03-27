<?php

namespace Selene\CMSBundle\Entity;

use Selene\CMSBundle\Interfaces\DatedEntityInterface;
use Selene\CMSBundle\Repository\BlogRepository;
use Selene\CMSBundle\Traits\EntityDate;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Selene\CMSBundle\Entity\ImageFile;

#[ORM\Entity(repositoryClass: BlogRepository::class)]
class Blog implements DatedEntityInterface
{
    use EntityDate;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\ManyToOne(inversedBy: 'blogs')]
    private ?User $author = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_created = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_updated = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $preview = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $DatePublished = null;

    #[ORM\ManyToOne]
    private ?ImageFile $imageFile = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getPreview(): ?string
    {
        return $this->preview;
    }

    public function setPreview(string $preview): self
    {
        $this->preview = $preview;

        return $this;
    }

    public function getDatePublished(): ?\DateTime
    {
        return $this->DatePublished;
    }

    public function setDatePublished(\DateTime $DatePublished): self
    {
        $this->DatePublished = $DatePublished;

        return $this;
    }
    public function getImageFile(): ?ImageFile
    {
        return $this->imageFile;
    }

        public function setImageFile(?ImageFile $imageFile): self
        {
            $this->imageFile = $imageFile;

            return $this;
        }
}
