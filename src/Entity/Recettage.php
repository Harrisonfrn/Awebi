<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;


/**
 * @ORM\Entity(repositoryClass="App\Repository\RecettageRepository")
 */
class Recettage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $navigator;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $ask;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $bug;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $ask_fonctionality;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    public function __construct()
    {
        $this->created_at = new \DateTime();
    }

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

    public function getSlug(): ?string
    {
        return (new Slugify())->slugify($this->title);
    }

    public function getNavigator(): ?string
    {
        return $this->navigator;
    }

    public function setNavigator(string $navigator): self
    {
        $this->navigator = $navigator;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getAsk(): ?string
    {
        return $this->ask;
    }

    public function setAsk(?string $ask): self
    {
        $this->ask = $ask;

        return $this;
    }

    public function getBug(): ?string
    {
        return $this->bug;
    }

    public function setBug(?string $bug): self
    {
        $this->bug = $bug;

        return $this;
    }

    public function getAskFonctionality(): ?string
    {
        return $this->ask_fonctionality;
    }

    public function setAskFonctionality(?string $ask_fonctionality): self
    {
        $this->ask_fonctionality = $ask_fonctionality;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
