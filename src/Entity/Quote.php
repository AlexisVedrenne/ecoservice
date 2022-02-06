<?php

namespace App\Entity;

use App\Repository\QuoteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuoteRepository::class)
 */
class Quote
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $NameProfessional;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\Column(type="date")
     */
    private $DateQuote;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $TotalPrice;

    /**
     * @ORM\ManyToOne(targetEntity=Commercial::class, inversedBy="quotes")
     */
    private $NameCommercial;



    public function __construct()
    {
        $this->Service = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameProfessional(): ?string
    {
        return $this->NameProfessional;
    }

    public function setNameProfessional(string $NameProfessional): self
    {
        $this->NameProfessional = $NameProfessional;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDateQuote(): ?\DateTimeInterface
    {
        return $this->DateQuote;
    }

    public function setDateQuote(\DateTimeInterface $DateQuote): self
    {
        $this->DateQuote = $DateQuote;

        return $this;
    }

    public function getTotalPrice(): ?string
    {
        return $this->TotalPrice;
    }

    public function setTotalPrice(string $TotalPrice): self
    {
        $this->TotalPrice = $TotalPrice;

        return $this;
    }

    public function getNameCommercial(): ?Commercial
    {
        return $this->NameCommercial;
    }

    public function setNameCommercial(?Commercial $NameCommercial): self
    {
        $this->NameCommercial = $NameCommercial;

        return $this;
    }

    /**
     * @return Collection|Service[]
     */
    public function getService(): Collection
    {
        return $this->Service;
    }
}
