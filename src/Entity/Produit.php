<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 */
class Produit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="integer")
     */
    private $dosage;

    /**
     * @ORM\Column(type="integer")
     */
    private $stock;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Promotion", inversedBy="produits")
     */
    private $promotion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commande", inversedBy="produits")
     */
    private $commande;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Assoiffeur", inversedBy="produits")
     */
    private $assoiffeur;

    public function __construct()
    {
        $this->promotion = new ArrayCollection();
        $this->assoiffeur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDosage(): ?int
    {
        return $this->dosage;
    }

    public function setDosage(int $dosage): self
    {
        $this->dosage = $dosage;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection|Promotion[]
     */
    public function getPromotion(): Collection
    {
        return $this->promotion;
    }

    public function addPromotion(Promotion $promotion): self
    {
        if (!$this->promotion->contains($promotion)) {
            $this->promotion[] = $promotion;
        }

        return $this;
    }

    public function removePromotion(Promotion $promotion): self
    {
        if ($this->promotion->contains($promotion)) {
            $this->promotion->removeElement($promotion);
        }

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * @return Collection|Assoiffeur[]
     */
    public function getAssoiffeur(): Collection
    {
        return $this->assoiffeur;
    }

    public function addAssoiffeur(Assoiffeur $assoiffeur): self
    {
        if (!$this->assoiffeur->contains($assoiffeur)) {
            $this->assoiffeur[] = $assoiffeur;
        }

        return $this;
    }

    public function removeAssoiffeur(Assoiffeur $assoiffeur): self
    {
        if ($this->assoiffeur->contains($assoiffeur)) {
            $this->assoiffeur->removeElement($assoiffeur);
        }

        return $this;
    }
}
