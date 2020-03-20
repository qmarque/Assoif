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
        return $this->render('assoiffeur/index.html.twig', [
            'controller_name' => 'AssoifController',
        ]);
    }
}
