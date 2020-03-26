<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AssoifController extends AbstractController
{
    /**
     * @Route("/", name="assoif")
     */
    public function accueil()
    {
        return $this->render('assoif/index.html.twig', [
            'controller_name' => 'AssoifController',
        ]);
    }

    /**
     * @Route("/assoiffeur", name="assoiffeur_accueil")
     */
    public function accueil_Assoiffeur()
    {
        return $this->render('assoiffeur/baseassoiffeur.html.twig', [
            'controller_name' => 'AssoifController',
        ]);
    }
    //aller chercher info avec serveur http

    /**
     * @Route("/assoiffe", name="assoiffe_accueil")
     */
    public function accueil_Assoiffe()
    {
        return $this->render('assoiffe/baseassoiffe.html.twig', [
            'controller_name' => 'AssoifController',
        ]);
    }


}
