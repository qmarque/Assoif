<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssoiffeurRepository")
 */
class Assoiffeur
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
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mdp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mdpProvisoire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomGerant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $siegeSocial;

    /**
     * @ORM\Column(type="integer")
     */
    private $siret;

    /**
     * @ORM\Column(type="integer")
     */
    private $siren;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $logo;

    /**
     * @ORM\Column(type="date")
     */
    private $periodeFermeture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bd;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Produit", mappedBy="assoiffeur")
     */
    private $produits;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Administrateur", inversedBy="assoiffeurs")
     */
    private $administrateur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Satistique", mappedBy="assoiffeur")
     */
    private $statistique;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Notification", inversedBy="assoiffeurs")
     */
    private $notification;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
        $this->statistique = new ArrayCollection();
        $this->notification = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getMdpProvisoire(): ?string
    {
        return $this->mdpProvisoire;
    }

    public function setMdpProvisoire(string $mdpProvisoire): self
    {
        $this->mdpProvisoire = $mdpProvisoire;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getNomGerant(): ?string
    {
        return $this->nomGerant;
    }

    public function setNomGerant(string $nomGerant): self
    {
        $this->nomGerant = $nomGerant;

        return $this;
    }

    public function getSiegeSocial(): ?string
    {
        return $this->siegeSocial;
    }

    public function setSiegeSocial(string $siegeSocial): self
    {
        $this->siegeSocial = $siegeSocial;

        return $this;
    }

    public function getSiret(): ?int
    {
        return $this->siret;
    }

    public function setSiret(int $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getSiren(): ?int
    {
        return $this->siren;
    }

    public function setSiren(int $siren): self
    {
        $this->siren = $siren;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getPeriodeFermeture(): ?\DateTimeInterface
    {
        return $this->periodeFermeture;
    }

    public function setPeriodeFermeture(\DateTimeInterface $periodeFermeture): self
    {
        $this->periodeFermeture = $periodeFermeture;

        return $this;
    }

    public function getBd(): ?string
    {
        return $this->bd;
    }

    public function setBd(string $bd): self
    {
        $this->bd = $bd;

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
            $produit->addAssoiffeur($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->contains($produit)) {
            $this->produits->removeElement($produit);
            $produit->removeAssoiffeur($this);
        }

        return $this;
    }

    public function getAdministrateur(): ?Administrateur
    {
        return $this->administrateur;
    }

    public function setAdministrateur(?Administrateur $administrateur): self
    {
        $this->administrateur = $administrateur;

        return $this;
    }

    /**
     * @return Collection|Satistique[]
     */
    public function getStatistique(): Collection
    {
        return $this->statistique;
    }

    public function addStatistique(Satistique $statistique): self
    {
        if (!$this->statistique->contains($statistique)) {
            $this->statistique[] = $statistique;
            $statistique->setAssoiffeur($this);
        }

        return $this;
    }

    public function removeStatistique(Satistique $statistique): self
    {
        if ($this->statistique->contains($statistique)) {
            $this->statistique->removeElement($statistique);
            // set the owning side to null (unless already changed)
            if ($statistique->getAssoiffeur() === $this) {
                $statistique->setAssoiffeur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Notification[]
     */
    public function getNotification(): Collection
    {
        return $this->notification;
    }

    public function addNotification(Notification $notification): self
    {
        if (!$this->notification->contains($notification)) {
            $this->notification[] = $notification;
        }

        return $this;
    }

    public function removeNotification(Notification $notification): self
    {
        if ($this->notification->contains($notification)) {
            $this->notification->removeElement($notification);
        }

        return $this;
    }
}
