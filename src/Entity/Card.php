<?php

namespace App\Entity;

use App\Repository\CardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CardRepository::class)
 */
class Card
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
    private $NumberCard;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $NameCard;

    /**
     * @ORM\Column(type="date")
     */
    private $ExpirationDate;

    /**
     * @ORM\ManyToOne(targetEntity=CardType::class, inversedBy="cards")
     */
    private $CardType;

    /**
     * @ORM\ManyToOne(targetEntity=Particulier::class, inversedBy="cards")
     */
    private $Particulier;

    /**
     * @ORM\OneToMany(targetEntity=Payment::class, mappedBy="Card")
     */
    private $payments;

    public function __construct()
    {
        $this->payments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberCard(): ?string
    {
        return $this->NumberCard;
    }

    public function setNumberCard(string $NumberCard): self
    {
        $this->NumberCard = $NumberCard;

        return $this;
    }

    public function getNameCard(): ?string
    {
        return $this->NameCard;
    }

    public function setNameCard(string $NameCard): self
    {
        $this->NameCard = $NameCard;

        return $this;
    }

    public function getExpirationDate(): ?\DateTimeInterface
    {
        return $this->ExpirationDate;
    }

    public function setExpirationDate(\DateTimeInterface $ExpirationDate): self
    {
        $this->ExpirationDate = $ExpirationDate;

        return $this;
    }

    public function getCardType(): ?CardType
    {
        return $this->CardType;
    }

    public function setCardType(?CardType $CardType): self
    {
        $this->CardType = $CardType;

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
            $payment->setCard($this);
        }

        return $this;
    }

    public function removePayment(Payment $payment): self
    {
        if ($this->payments->removeElement($payment)) {
            // set the owning side to null (unless already changed)
            if ($payment->getCard() === $this) {
                $payment->setCard(null);
            }
        }

        return $this;
    }
}
