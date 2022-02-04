<?php

namespace App\Entity;

use App\Repository\CommentaryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentaryRepository::class)
 */
class Commentary
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Particulier::class, inversedBy="commentaries")
     */
    private $Particulier;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="commentaries")
     */
    private $Product;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Comment;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParticulier(): ?Particulier
    {
        return $this->Particulier;
    }

    public function setParticulier(?Particulier $Particulier): self
    {
        $this->Particulier = $Particulier;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->Product;
    }

    public function setProduct(?Product $Product): self
    {
        $this->Product = $Product;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->Comment;
    }

    public function setComment(string $Comment): self
    {
        $this->Comment = $Comment;

        return $this;
    }
}
