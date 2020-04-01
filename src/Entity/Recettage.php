<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecettageRepository")
 */
class Recettage
{
    const NAVIGATOR = [
        0 => 'Chrome',
        1 => 'Firefox',
        2 => 'Explorer',
        3 => 'Qwant'
    ];

    const STATUS = [
        0 => 'Non planiffiée',
        1 => 'Planifiée',
        2 => 'En cours',
        3 => 'Terminer'
    ];

    const ASK = [
        0 => 'Produit',
        1 => 'Platforme'
    ];

    const BUG = [
        0 => 'Produit',
        1 => 'Platforme',
        2 => 'Environement et version',
        3 => 'Navigateur',
        4 => 'Gravité'
    ];

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
     * @ORM\Column(type="integer")
     */
    private $navigator;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ask;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $askFonctionnality;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

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

    public function getNavigator(): ?int
    {
        return $this->navigator;
    }

    public function setNavigator(int $navigator): self
    {
        $this->navigator = $navigator;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getAsk(): ?int
    {
        return $this->ask;
    }

    public function setAsk(?int $ask): self
    {
        $this->ask = $ask;

        return $this;
    }

    public function getBug(): ?int
    {
        return $this->bug;
    }

    public function setBug(?int $bug): self
    {
        $this->bug = $bug;

        return $this;
    }

    public function getAskFonctionnality(): ?string
    {
        return $this->askFonctionnality;
    }

    public function setAskFonctionnality(?string $askFonctionnality): self
    {
        $this->askFonctionnality = $askFonctionnality;

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
