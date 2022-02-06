<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
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
     * @ORM\Column(type="string", length=255)
     */
    private $Des;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Reference;

    /**
     * @ORM\ManyToOne(targetEntity=CategoryService::class, inversedBy="services")
     */
    private $CategoryService;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Price;

    /**
     * @ORM\Column(type="boolean")
     */
    private $State;

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

    public function getReference(): ?string
    {
        return $this->Reference;
    }

    public function setReference(string $Reference): self
    {
        $this->Reference = $Reference;

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

    public function getPrice(): ?string
    {
        return $this->Price;
    }

    public function setPrice(string $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getState(): ?bool
    {
        return $this->State;
    }

    public function setState(bool $State): self
    {
        $this->State = $State;

        return $this;
    }
}
