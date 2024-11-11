<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Comment 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id=null;

    #[ORM\Column(type: 'text')]
    private string $content;

    #[ORM\ManyToOne(targetEntity: Card::class, inversedBy: 'commnets')]
    #[ORM\JoinColumn(nullable : false)]
    private Card $card;

    #[ORM\ManyToMany(targetEntity: User::class)]
    private User $user;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getContent(): ?string{
        return $this->content;
    }

    public function setContent(string $content): self
    {
        if (empty(trim($content))) {
            throw new \InvalidArgumentException('Content cannot be empty.');
        }

        $this->content = $content;
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

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }
}