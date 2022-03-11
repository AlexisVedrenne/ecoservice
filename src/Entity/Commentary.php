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
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commentaries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $particulier;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="commentaries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $comment;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParticulier(): ?User
    {
        return $this->particulier;
    }

    public function setParticulier(?User $particulier): self
    {
        $this->particulier = $particulier;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }
}
