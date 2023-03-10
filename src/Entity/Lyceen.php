<?php

namespace App\Entity;

use App\Repository\LyceenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\PseudoTypes\True_;

#[ORM\Entity(repositoryClass: LyceenRepository::class)]
class Lyceen extends User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?Lycee $lycee = null;

    #[ORM\ManyToMany(targetEntity: Atelier::class, mappedBy: 'lyceen')]
    private Collection $ateliers;

    #[ORM\ManyToOne(inversedBy: 'lyceens')]
    private ?Section $section = null;

    #[ORM\ManyToOne(inversedBy: 'lyceens')]
    #[ORM\JoinColumn(nullable: True)]
    private ?User $user = null;

    #[ORM\ManyToMany(targetEntity: Reponse::class, mappedBy: 'lyceen')]
    private Collection $reponses;

    public function __construct()
    {
        parent::__construct();
        $this->ateliers = new ArrayCollection();
        $this->reponses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLycee(): ?Lycee
    {
        return $this->lycee;
    }

    public function setLycee(?Lycee $lycee): self
    {
        $this->lycee = $lycee;

        return $this;
    }

    /**
     * @return Collection<int, Atelier>
     */
    public function getAteliers(): Collection
    {
        return $this->ateliers;
    }

    public function addAtelier(Atelier $atelier): self
    {
        if (!$this->ateliers->contains($atelier)) {
            $this->ateliers->add($atelier);
            $atelier->addLyceen($this);
        }

        return $this;
    }

    public function removeAtelier(Atelier $atelier): self
    {
        if ($this->ateliers->removeElement($atelier)) {
            $atelier->removeLyceen($this);
        }

        return $this;
    }

    public function getIdParent()
    {
        return parent::getFirstName() . " " . parent::getLastName();
    }

    public function getIdP()
    {
        return parent::getId();
    }

    public function getSection(): ?Section
    {
        return $this->section;
    }

    public function setSection(?Section $section): self
    {
        $this->section = $section;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
    

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Collection<int, Reponse>
     */
    public function getReponses(): Collection
    {
        return $this->reponses;
    }

    public function addReponse(Reponse $reponse): self
    {
        if (!$this->reponses->contains($reponse)) {
            $this->reponses->add($reponse);
            $reponse->addLyceen($this);
        }

        return $this;
    }

    public function removeReponse(Reponse $reponse): self
    {
        if ($this->reponses->removeElement($reponse)) {
            $reponse->removeLyceen($this);
        }

        return $this;
    }
}
