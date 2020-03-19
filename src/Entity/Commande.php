<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbProduitParType;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbProduitTotal;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Produit", mappedBy="commande")
     */
    private $produits;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Assoiffe", inversedBy="commande")
     */
    private $assoiffe;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbProduitParType(): ?int
    {
        return $this->nbProduitParType;
    }

    public function setNbProduitParType(int $nbProduitParType): self
    {
        $this->nbProduitParType = $nbProduitParType;

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

    public function getNbProduitTotal(): ?int
    {
        return $this->nbProduitTotal;
    }

    public function setNbProduitTotal(int $nbProduitTotal): self
    {
        $this->nbProduitTotal = $nbProduitTotal;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setCommande($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->contains($produit)) {
            $this->produits->removeElement($produit);
            // set the owning side to null (unless already changed)
            if ($produit->getCommande() === $this) {
                $produit->setCommande(null);
            }
        }

        return $this;
    }

    public function getAssoiffe(): ?Assoiffe
    {
        return $this->assoiffe;
    }

    public function setAssoiffe(?Assoiffe $assoiffe): self
    {
        $this->assoiffe = $assoiffe;

        return $this;
    }
}
