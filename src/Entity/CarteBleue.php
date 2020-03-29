<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="App\Repository\CarteBleueRepository")
*/
class CarteBleue
{
    /**
    * @ORM\Id()
    * @ORM\GeneratedValue()
    * @ORM\Column(type="integer")
    */
    private $id;
    
    /**
    * @ORM\Column(type="string", length=255)
    * @Assert\NotBlank
    */
    private $nomTitulaire;
    
    /**
    * @ORM\Column(type="integer")
    * @Assert\NotBlank
    * @Assert\Regex(pattern="# [0-9]{16} #",message="Il semble y avoir un problème avec le numéro")
    */
    private $numero;
    
    /**
    * @ORM\Column(type="integer")
    * @Assert\NotBlank
    * @Assert\Regex(pattern="# [0-9]{4} #",message="Il semble y avoir un problème avec la date d'expiration (mm-yy")
    
    */
    private $dateExpiration;
    
    /**
    * @ORM\Column(type="integer")
    * @Assert\NotBlank
    * @Assert\Regex(pattern="# [0-9]{3} #",message="Il semble y avoir un problème avec le cryptogamme")
    */
    private $cryptogramme;
    
    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getNomTitulaire(): ?string
    {
        return $this->nomTitulaire;
    }
    
    public function setNomTitulaire(string $nomTitulaire): self
    {
        $this->nomTitulaire = $nomTitulaire;
        
        return $this;
    }
    
    public function getNumero(): ?int
    {
        return $this->numero;
    }
    
    public function setNumero(int $numero): self
    {
        $this->numero = $numero;
        
        return $this;
    }
    
    public function getDateExpiration(): ?\DateTimeInterface
    {
        return $this->dateExpiration;
    }
    
    public function setDateExpiration(\DateTimeInterface $dateExpiration): self
    {
        $this->dateExpiration = $dateExpiration;
        
        return $this;
    }
    
    public function getCryptogramme(): ?int
    {
        return $this->cryptogramme;
    }
    
    public function setCryptogramme(int $cryptogramme): self
    {
        $this->cryptogramme = $cryptogramme;
        
        return $this;
    }
}
