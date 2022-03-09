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
     * @ORM\Column(type="string", length=100)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $des;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $reference;

    /**
     * @ORM\ManyToOne(targetEntity=CategoryService::class, inversedBy="services")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoryService;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $price;

    /**
     * @ORM\Column(type="boolean")
     */
    private $state;

    /**
     * @ORM\ManyToMany(targetEntity=Quote::class, mappedBy="service")
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
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDes(): ?string
    {
        return $this->des;
    }

    public function setDes(string $des): self
    {
        $this->des = $des;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getCategoryService(): ?CategoryService
    {
        return $this->categoryService;
    }

    public function setCategoryService(?CategoryService $categoryService): self
    {
        $this->categoryService = $categoryService;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getState(): ?bool
    {
        return $this->state;
    }

    public function setState(bool $state): self
    {
        $this->state = $state;

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
