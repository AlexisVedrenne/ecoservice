<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
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
     * @ORM\Column(type="string", length=50)
     */
    private $Ref;

    /**
     * @ORM\ManyToOne(targetEntity=CategoryProduct::class, inversedBy="products")
     */
    private $CategoryPoduct;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Quantity;

    /**
     * @ORM\Column(type="boolean")
     */
    private $State;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $RecyclingIndex;

    /**
     * @ORM\OneToMany(targetEntity=Commentary::class, mappedBy="Product")
     */
    private $commentaries;

    /**
     * @ORM\ManyToMany(targetEntity=Payment::class, mappedBy="Product")
     */
    private $payments;

    /**
     * @ORM\ManyToMany(targetEntity=OrderProduct::class, mappedBy="Product")
     */
    private $orderProducts;



    public function __construct()
    {
        $this->commentaries = new ArrayCollection();
        $this->payments = new ArrayCollection();
        $this->orderProducts = new ArrayCollection();
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

    public function getRef(): ?string
    {
        return $this->Ref;
    }

    public function setRef(string $Ref): self
    {
        $this->Ref = $Ref;

        return $this;
    }

    public function getCategoryPoduct(): ?CategoryProduct
    {
        return $this->CategoryPoduct;
    }

    public function setCategoryPoduct(?CategoryProduct $CategoryPoduct): self
    {
        $this->CategoryPoduct = $CategoryPoduct;

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

    public function getQuantity(): ?string
    {
        return $this->Quantity;
    }

    public function setQuantity(string $Quantity): self
    {
        $this->Quantity = $Quantity;

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

    public function getRecyclingIndex(): ?string
    {
        return $this->RecyclingIndex;
    }

    public function setRecyclingIndex(string $RecyclingIndex): self
    {
        $this->RecyclingIndex = $RecyclingIndex;

        return $this;
    }

    /**
     * @return Collection|Commentary[]
     */
    public function getCommentaries(): Collection
    {
        return $this->commentaries;
    }

    public function addCommentary(Commentary $commentary): self
    {
        if (!$this->commentaries->contains($commentary)) {
            $this->commentaries[] = $commentary;
            $commentary->setProduct($this);
        }

        return $this;
    }

    public function removeCommentary(Commentary $commentary): self
    {
        if ($this->commentaries->removeElement($commentary)) {
            // set the owning side to null (unless already changed)
            if ($commentary->getProduct() === $this) {
                $commentary->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Payment[]
     */
    public function getPayments(): Collection
    {
        return $this->payments;
    }

    public function addPayment(Payment $payment): self
    {
        if (!$this->payments->contains($payment)) {
            $this->payments[] = $payment;
            $payment->addProduct($this);
        }

        return $this;
    }

    public function removePayment(Payment $payment): self
    {
        if ($this->payments->removeElement($payment)) {
            $payment->removeProduct($this);
        }

        return $this;
    }

    /**
     * @return Collection|OrderProduct[]
     */
    public function getOrderProducts(): Collection
    {
        return $this->orderProducts;
    }

    public function addOrderProduct(OrderProduct $orderProduct): self
    {
        if (!$this->orderProducts->contains($orderProduct)) {
            $this->orderProducts[] = $orderProduct;
            $orderProduct->addProduct($this);
        }

        return $this;
    }

    public function removeOrderProduct(OrderProduct $orderProduct): self
    {
        if ($this->orderProducts->removeElement($orderProduct)) {
            $orderProduct->removeProduct($this);
        }

        return $this;
    }
}
