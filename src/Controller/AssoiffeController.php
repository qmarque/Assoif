<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Administrateur;
use App\Entity\Assoiffe;
use App\Entity\Assoiffeur;
use App\Entity\CarteBleue;
use App\Entity\Commande;
use App\Entity\Notification;
use App\Entity\Produit;
use App\Entity\Promotion;
use App\Entity\Satistiques;
use App\Entity\TypeProduit;
use App\Form\CarteBleueType;
use App\Repository\ProduitRepository;
use App\Repository\TypeProduitRepository;


/**
* @Route("/assoiffe")
*/
class AssoiffeController extends AbstractController
{
    /**
    * @Route("/", name="map")
    */
    public function map()
    {
        return $this->render('assoiffe/map.html.twig', ['controller_name' => 'AssoifController',]);
    }
    
        
    /**
    * @Route("/accueil", name="accueil_assoiffe")
    */
    public function accueil_Assoiffe(TypeProduitRepository $typeProduitRepository)
    {
        return $this->render('type_produit/index.html.twig', [
            'typesProduit' => $typeProduitRepository->findAll(),
            'action' => "assoiffe",
            ]);
    }
}
