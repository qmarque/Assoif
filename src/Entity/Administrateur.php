<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdministrateurRepository")
 */
class Administrateur
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
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mdp;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Assoiffeur", mappedBy="administrateur")
     */
    private $assoiffeurs;

    public function __construct()
    {
        $this->assoiffeurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection|Assoiffeur[]
     */
    public function getAssoiffeurs(): Collection
    {
        return $this->assoiffeurs;
    }

    public function addAssoiffeur(Assoiffeur $assoiffeur): self
    {
        if (!$this->assoiffeurs->contains($assoiffeur)) {
            $this->assoiffeurs[] = $assoiffeur;
            $assoiffeur->setAdministrateur($this);
        }

        return $this;
    }

    public function removeAssoiffeur(Assoiffeur $assoiffeur): self
    {
        if ($this->assoiffeurs->contains($assoiffeur)) {
            $this->assoiffeurs->removeElement($assoiffeur);
            // set the owning side to null (unless already changed)
            if ($assoiffeur->getAdministrateur() === $this) {
                $assoiffeur->setAdministrateur(null);
            }
        }

        return $this;
    }
}
