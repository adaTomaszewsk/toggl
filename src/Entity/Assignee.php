<?php 

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Assignee {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id=null;

    #[ORM\ManyToOne(targetEntity:Card::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Card $card;

    #[ORM\ManyToOne(targetEntity:User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

     public function getId(): ?int
     {
        return $this->id;
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