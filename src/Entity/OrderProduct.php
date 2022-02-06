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
    private $DateOrder;

    /**
     * @ORM\ManyToMany(targetEntity=product::class, inversedBy="orderProducts")
     */
    private $Product;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $QuantityProduct;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $TotalPrice;

    /**
     * @ORM\OneToOne(targetEntity=Payment::class, cascade={"persist", "remove"})
     */
    private $Payment;

    /**
     * @ORM\ManyToOne(targetEntity=Particulier::class, inversedBy="orderProducts")
     */
    private $Particulier;



    public function __construct()
    {
        $this->Product = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateOrder(): ?\DateTimeInterface
    {
        return $this->DateOrder;
    }

    public function setDateOrder(\DateTimeInterface $DateOrder): self
    {
        $this->DateOrder = $DateOrder;

        return $this;
    }

    /**
     * @return Collection|product[]
     */
    public function getProduct(): Collection
    {
        return $this->Product;
    }

    public function addProduct(product $product): self
    {
        if (!$this->Product->contains($product)) {
            $this->Product[] = $product;
        }

        return $this;
    }

    public function removeProduct(product $product): self
    {
        $this->Product->removeElement($product);

        return $this;
    }

    public function getQuantityProduct(): ?string
    {
        return $this->QuantityProduct;
    }

    public function setQuantityProduct(string $QuantityProduct): self
    {
        $this->QuantityProduct = $QuantityProduct;

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

    public function getPayment(): ?Payment
    {
        return $this->Payment;
    }

    public function setPayment(?Payment $Payment): self
    {
        $this->Payment = $Payment;

        return $this;
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
}
