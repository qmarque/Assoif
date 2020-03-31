<?php

namespace App\Controller;

use App\Entity\TypeProduit;
use App\Form\TypeProduitType;
use App\Repository\TypeProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("/typeproduit")
*/
class TypeProduitController extends AbstractController
{
    /**
     * @Route("/new", name="type_produit_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeProduit = new TypeProduit();
        $form = $this->createForm(TypeProduitType::class, $typeProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeProduit);
            $entityManager->flush();

            return $this->redirectToRoute('accueil_assoiffeur');
        }

        return $this->render('type_produit/new.html.twig', [
            'type_produit' => $typeProduit,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("assoiffe/produit/{id}", name="type_produit_show_assoiffe", methods={"GET"})
     */
    public function showAssoiffe(TypeProduit $typeProduit): Response
    {
        return $this->render('type_produit/show.html.twig', [
            'type_produit' => $typeProduit,
            'action' => "assoiffe",
        ]);
    }


    /**
     * @Route("assoiffeur/produit/{id}", name="type_produit_show_assoiffeur", methods={"GET"})
     */
    public function showAssoiffeur(TypeProduit $typeProduit): Response
    {
        return $this->render('type_produit/show.html.twig', [
            'type_produit' => $typeProduit,
            'action' => "assoiffeur",
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_produit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeProduit $typeProduit): Response
    {
        $form = $this->createForm(TypeProduitType::class, $typeProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('accueil_assoiffeur');
        }

        return $this->render('type_produit/edit.html.twig', [
            'type_produit' => $typeProduit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_produit_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeProduit $typeProduit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeProduit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeProduit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('accueil_assoiffeur');
    }
}
