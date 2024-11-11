<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class Column
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'columns')]
    #[ORM\JoinColumn(nullable: false)]
    private Project $project;

    #[ORM\OneToMany(mappedBy: 'column', targetEntity: Card::class, cascade: ['persist', 'remove'])]
    private Collection $cards;

    public function __construct()
    {
        $this->cards = new ArrayCollection();
    }

    public function getId(): ?int
{
    return $this->id;
}
public function getName(): string
{
    return $this->name;
}

public function setName(string $name): self
{
    if (empty(trim($name))) {
        throw new \InvalidArgumentException('Column name cannot be empty.');
    }

    $this->name = $name;
    return $this;
}
public function getProject(): ?Project
{
    return $this->project;
}

public function setProject(?Project $project): self
{
    $this->project = $project;
    return $this;
}

/**
 * @return Collection|Card[]
 */
public function getCards(): Collection
{
    return $this->cards;
}

public function addCard(Card $card): self
{
    if (!$this->cards->contains($card)) {
        $this->cards[] = $card;
        $card->setColumn($this); 
    }
    return $this;
}

public function removeCard(Card $card): self
{
    if ($this->cards->contains($card)) {
        $this->cards->removeElement($card);
        if ($card->getColumn() === $this) {
            $card->setColumn(null);
        }
    }
    return $this;
}
}