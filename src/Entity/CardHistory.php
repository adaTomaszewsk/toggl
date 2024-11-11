<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;

#[ORM\Entity]
class CardHistory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $action;

    #[ORM\Column(type: 'datetime')]
    private DateTimeInterface $timestamp;

    #[ORM\ManyToOne(targetEntity: Card::class, inversedBy: 'history')]
    #[ORM\JoinColumn(nullable: false)]
    private Card $card;

    #[ORM\ManyToOne(targetEntity: User::class)]
    private ?User $performedBy = null;

    public function __construct()
    {
        $this->timestamp = new \DateTime(); 
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function setAction(string $action): self
    {
        if (empty(trim($action))) {
            throw new \InvalidArgumentException('Action cannot be empty.');
        }

        $this->action = $action;
        return $this;
    }
    public function getTimestamp(): DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(DateTimeInterface $timestamp): self
    {
        $this->timestamp = $timestamp;
        return $this;
    }

    public function getCard(): ?Card
    {
        return $this->card;
    }

    public function setCard(?Card $card): self
    {
        $this->card = $card;
        return $this;
    }
    public function getPerformedBy(): ?User
    {
        return $this->performedBy;
    }

    public function setPerformedBy(?User $user): self
    {
        $this->performedBy = $user;
        return $this;
    }

}