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
    private $numberCard;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nameCard;

    /**
     * @ORM\Column(type="date")
     */
    private $expirationDate;

    /**
     * @ORM\ManyToOne(targetEntity=CardType::class, inversedBy="cards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cardType;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="cards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $particulier;

    /**
     * @ORM\OneToMany(targetEntity=Payment::class, mappedBy="card")
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
        return $this->numberCard;
    }

    public function setNumberCard(string $numberCard): self
    {
        $this->numberCard = $numberCard;

        return $this;
    }

    public function getNameCard(): ?string
    {
        return $this->nameCard;
    }

    public function setNameCard(string $nameCard): self
    {
        $this->nameCard = $nameCard;

        return $this;
    }

    public function getExpirationDate(): ?\DateTimeInterface
    {
        return $this->expirationDate;
    }

    public function setExpirationDate(\DateTimeInterface $expirationDate): self
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    public function getCardType(): ?CardType
    {
        return $this->cardType;
    }

    public function setCardType(?CardType $cardType): self
    {
        $this->cardType = $cardType;

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
