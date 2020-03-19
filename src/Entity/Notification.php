<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NotificationRepository")
 */
class Notification
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
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Assoiffeur", mappedBy="notification")
     */
    private $assoiffeurs;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Assoiffe", inversedBy="notification")
     */
    private $assoiffe;

    public function __construct()
    {
        $this->assoiffeurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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
            $assoiffeur->addNotification($this);
        }

        return $this;
    }

    public function removeAssoiffeur(Assoiffeur $assoiffeur): self
    {
        if ($this->assoiffeurs->contains($assoiffeur)) {
            $this->assoiffeurs->removeElement($assoiffeur);
            $assoiffeur->removeNotification($this);
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
