<?php

namespace App\Entity;

use App\Repository\AtelierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AtelierRepository::class)]
class Atelier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 255)]
    private ?string $nomAtelier = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateAtelier = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $urlRessource = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private $pdfRessource = null;


    #[ORM\ManyToMany(targetEntity: Metier::class, inversedBy: 'ateliers')]
    private Collection $metier;


    #[ORM\ManyToOne(inversedBy: 'ateliers')]
    private ?Secteur $secteur = null;

    #[ORM\ManyToOne(inversedBy: 'ateliers')]
    private ?Salle $salle = null;

    #[ORM\ManyToMany(targetEntity: Intervenant::class, inversedBy: 'ateliers')]
    private Collection $intervenant;

    #[ORM\ManyToMany(targetEntity: Lyceen::class, inversedBy: 'ateliers')]
    private Collection $lyceen;

    public function __construct()
    {
        $this->metier = new ArrayCollection();
        $this->intervenant = new ArrayCollection();
        $this->lyceen = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getNomAtelier(): ?string
    {
        return $this->nomAtelier;
    }

    public function setNomAtelier(string $nomAtelier): self
    {
        $this->nomAtelier = $nomAtelier;

        return $this;
    }

    public function getDateAtelier(): ?\DateTimeInterface
    {
        return $this->dateAtelier;
    }

    public function setDateAtelier(\DateTimeInterface $dateAtelier): self
    {
        $this->dateAtelier = $dateAtelier;

        return $this;
    }

    public function getUrlRessource(): ?string
    {
        return $this->urlRessource;
    }

    public function setUrlRessource(?string $urlRessource): self
    {
        $this->urlRessource = $urlRessource;

        return $this;
    }

    public function getPdfRessource()
    {
        return $this->pdfRessource;
    }

    public function setPdfRessource($pdfRessource): self
    {
        $this->pdfRessource = $pdfRessource;

        return $this;
    }

   

    /**
     * @return Collection<int, Metier>
     */
    public function getMetier(): Collection
    {
        return $this->metier;
    }

    public function addMetier(Metier $metier): self
    {
        if (!$this->metier->contains($metier)) {
            $this->metier->add($metier);
        }

        return $this;
    }

    public function removeMetier(Metier $metier): self
    {
        $this->metier->removeElement($metier);

        return $this;
    }

    public function __toString()
    {
        return (String)$this->nomAtelier;
    }

    public function getSecteur(): ?Secteur
    {
        return $this->secteur;
    }

    public function setSecteur(?Secteur $secteur): self
    {
        $this->secteur = $secteur;

        return $this;
    }

    public function getSalle(): ?Salle
    {
        return $this->salle;
    }

    public function setSalle(?Salle $salle): self
    {
        $this->salle = $salle;

        return $this;
    }

    /**
     * @return Collection<int, Intervenant>
     */
    public function getIntervenant(): Collection
    {
        return $this->intervenant;
    }

    public function addIntervenant(Intervenant $intervenant): self
    {
        if (!$this->intervenant->contains($intervenant)) {
            $this->intervenant->add($intervenant);
        }

        return $this;
    }

    public function removeIntervenant(Intervenant $intervenant): self
    {
        $this->intervenant->removeElement($intervenant);

        return $this;
    }

    /**
     * @return Collection<int, Lyceen>
     */
    public function getLyceen(): Collection
    {
        return $this->lyceen;
    }

    public function addLyceen(Lyceen $lyceen): self
    {
        if (!$this->lyceen->contains($lyceen)) {
            $this->lyceen->add($lyceen);
        }

        return $this;
    }

    public function removeLyceen(Lyceen $lyceen): self
    {
        $this->lyceen->removeElement($lyceen);

        return $this;
    }

}
