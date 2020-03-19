<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SatistiqueRepository")
 */
class Satistique
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
    private $chchiffreAffaire;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbCommandeParJour;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbVerresParPers;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $meilleureVente;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $horairePointe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Assoiffeur", inversedBy="statistique")
     */
    private $assoiffeur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChchiffreAffaire(): ?int
    {
        return $this->chchiffreAffaire;
    }

    public function setChchiffreAffaire(int $chchiffreAffaire): self
    {
        $this->chchiffreAffaire = $chchiffreAffaire;

        return $this;
    }

    public function getNbCommandeParJour(): ?int
    {
        return $this->nbCommandeParJour;
    }

    public function setNbCommandeParJour(int $nbCommandeParJour): self
    {
        $this->nbCommandeParJour = $nbCommandeParJour;

        return $this;
    }

    public function getNbVerresParPers(): ?int
    {
        return $this->nbVerresParPers;
    }

    public function setNbVerresParPers(int $nbVerresParPers): self
    {
        $this->nbVerresParPers = $nbVerresParPers;

        return $this;
    }

    public function getMeilleureVente(): ?string
    {
        return $this->meilleureVente;
    }

    public function setMeilleureVente(string $meilleureVente): self
    {
        $this->meilleureVente = $meilleureVente;

        return $this;
    }

    public function getHorairePointe(): ?string
    {
        return $this->horairePointe;
    }

    public function setHorairePointe(string $horairePointe): self
    {
        $this->horairePointe = $horairePointe;

        return $this;
    }

    public function getAssoiffeur(): ?Assoiffeur
    {
        return $this->assoiffeur;
    }

    public function setAssoiffeur(?Assoiffeur $assoiffeur): self
    {
        $this->assoiffeur = $assoiffeur;

        return $this;
    }
}
