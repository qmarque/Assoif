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
 * @Route("/assoiffeur")
 */
class AssoiffeurController extends AbstractController
{
    /**
     * @Route("/", name="assoiffeur")
     */
    public function index()
    {
        return $this->render('assoiffeur/index.html.twig', [
            'controller_name' => 'AssoiffeurController',
        ]);
    }


    /**
    * @Route("/accueil", name="accueil_assoiffeur")
    */
    public function accueil_Assoiffeur(TypeProduitRepository $typeProduitRepository)
    {
        return $this->render('type_produit/index.html.twig', [
            'typesProduit' => $typeProduitRepository->findAll(),
            'action' => "assoiffeur",
            ]);
    }


    
}
