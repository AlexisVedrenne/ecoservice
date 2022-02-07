<?php

namespace App\Entity;

use App\Repository\OrderProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderProductRepository::class)
 */
class OrderProduct
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOrder;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, inversedBy="orderProducts")
     */
    private $product;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $quantityProduct;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="orderProducts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $particulier;

    /**
     * @ORM\OneToOne(targetEntity=Payment::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $payment;

    public function __construct()
    {
        $this->product = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateOrder(): ?\DateTimeInterface
    {
        return $this->dateOrder;
    }

    public function setDateOrder(\DateTimeInterface $dateOrder): self
    {
        $this->dateOrder = $dateOrder;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProduct(): Collection
    {
        return $this->product;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->product->contains($product)) {
            $this->product[] = $product;
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        $this->product->removeElement($product);

        return $this;
    }

    public function getQuantityProduct(): ?string
    {
        return $this->quantityProduct;
    }

    public function setQuantityProduct(string $quantityProduct): self
    {
        $this->quantityProduct = $quantityProduct;

        return $this;
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

    public function getPayment(): ?Payment
    {
        return $this->payment;
    }

    public function setPayment(Payment $payment): self
    {
        $this->payment = $payment;

        return $this;
    }
}
