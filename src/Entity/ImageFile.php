<?php

namespace Selene\CMSBundle\Entity;

use Selene\CMSBundle\Repository\ImageFileRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageFileRepository::class)]
class ImageFile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $filename = null;

    private ?string $tempFilename = null;

    private ?string $file = null;

    private ?string $webView = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getTempFilename(): ?string
    {
        return $this->tempFilename;
    }

    public function setTempFilename(string $tempFilename): self
    {
        $this->tempFilename = $tempFilename;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getWebView(): ?string
    {
        return $this->webView;
    }

    public function setWebView(string $webView): self
    {
        $this->webView = $webView;

        return $this;
    }
}
