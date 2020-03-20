<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AssoifController extends AbstractController
{
    /**
     * @Route("/assoif", name="assoif")
     */
    public function index()
    {
        return $this->render('assoif/index.html.twig', [
            'controller_name' => 'AssoifController',
        ]);
    }
}
