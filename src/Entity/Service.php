<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServiceRepository::class)
 */
class Service
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
    private $Image;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Des;

    /**
     * @ORM\ManyToOne(targetEntity=CategoryService::class, inversedBy="services")
     */
    private $CategoryService;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Commentary;

    /**
     * @ORM\ManyToMany(targetEntity=Quote::class, mappedBy="Service")
     */
    private $quotes;

    public function __construct()
    {
        $this->quotes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    public function getDes(): ?string
    {
        return $this->Des;
    }

    public function setDes(string $Des): self
    {
        $this->Des = $Des;

        return $this;
    }

    public function getCategoryService(): ?CategoryService
    {
        return $this->CategoryService;
    }

    public function setCategoryService(?CategoryService $CategoryService): self
    {
        $this->CategoryService = $CategoryService;

        return $this;
    }

    public function getCommentary(): ?string
    {
        return $this->Commentary;
    }

    public function setCommentary(string $Commentary): self
    {
        $this->Commentary = $Commentary;

        return $this;
    }

    /**
     * @return Collection|Quote[]
     */
    public function getQuotes(): Collection
    {
        return $this->quotes;
    }

    public function addQuote(Quote $quote): self
    {
        if (!$this->quotes->contains($quote)) {
            $this->quotes[] = $quote;
            $quote->addService($this);
        }

        return $this;
    }

    public function removeQuote(Quote $quote): self
    {
        if ($this->quotes->removeElement($quote)) {
            $quote->removeService($this);
        }

        return $this;
    }
}
