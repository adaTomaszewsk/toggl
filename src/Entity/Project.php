<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: Column::class, cascade: ['persist', 'remove'])]
    private Collection $columns;

    #[ORM\ManyToOne(targetEntity: User::class)]
    private ?User $createdBy = null;

    public function __construct()
    {
        $this->columns = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }    public function getName(): string
    {
        return $this->name;
    }
    
    public function setName(string $name): self
    {
        if (empty(trim($name))) {
            throw new \InvalidArgumentException('Project name cannot be empty.');
        }
    
        $this->name = $name;
        return $this;
    }    
    
    /**
    * @return Collection|Column[]
    */
   public function getColumns(): Collection
   {
       return $this->columns;
   }
   
   public function addColumn(Column $column): self
   {
       if (!$this->columns->contains($column)) {
           $this->columns[] = $column;
           $column->setProject($this); 
       }
       return $this;
   }
   
   public function removeColumn(Column $column): self
   {
       if ($this->columns->contains($column)) {
           $this->columns->removeElement($column);
           if ($column->getProject() === $this) {
               $column->setProject(null);
           }
       }
       return $this;
   }

   public function getCreatedBy(): ?User
   {
       return $this->createdBy;
   }
   
   public function setCreatedBy(?User $user): self
   {
       $this->createdBy = $user;
       return $this;
   }
   

}
