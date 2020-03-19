<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssoiffeRepository")
 */
class Assoiffe
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
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mdp;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Notification", mappedBy="assoiffe")
     */
    private $notification;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commande", mappedBy="assoiffe")
     */
    private $commande;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\CarteBleue", cascade={"persist", "remove"})
     */
    private $cartebleue;

    public function __construct()
    {
        $this->notification = new ArrayCollection();
        $this->commande = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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
            $notification->setAssoiffe($this);
        }

        return $this;
    }

    public function removeNotification(Notification $notification): self
    {
        if ($this->notification->contains($notification)) {
            $this->notification->removeElement($notification);
            // set the owning side to null (unless already changed)
            if ($notification->getAssoiffe() === $this) {
                $notification->setAssoiffe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommande(): Collection
    {
        return $this->commande;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commande->contains($commande)) {
            $this->commande[] = $commande;
            $commande->setAssoiffe($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commande->contains($commande)) {
            $this->commande->removeElement($commande);
            // set the owning side to null (unless already changed)
            if ($commande->getAssoiffe() === $this) {
                $commande->setAssoiffe(null);
            }
        }

        return $this;
    }

    public function getCartebleue(): ?CarteBleue
    {
        return $this->cartebleue;
    }

    public function setCartebleue(?CarteBleue $cartebleue): self
    {
        $this->cartebleue = $cartebleue;

        return $this;
    }
}
