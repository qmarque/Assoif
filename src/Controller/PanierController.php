<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\ProduitRepository;
use App\Entity\Assoiffe;
use App\Entity\Assoiffeur;
use App\Entity\Produit;

class PanierController extends AbstractController
{
    /**
    * @Route("assoiffe/panier", name="panier_index_assoiffe")
    */
    public function indexAssoiffe(SessionInterface $session , ProduitRepository $produitRepository)
    {
        $panier = $session->get('panier', []); // récupération du panier
        
        $panierWithData = [];
        
        foreach($panier as $id => $quantity){
            $panierWithData[]=
            [
                'produit' => $produitRepository->find($id), //trouver un produit grace à son id
                'quantity' => $quantity
            ];
            //dump($panierWithData);
            //dd($panierWithData);
        }
        
        // dd($panierWithData);
        
        $total=0;
        foreach($panierWithData as $item){
            $totalItem=$item['produit']->getPrix() * $item['quantity'];
            $total+=$totalItem;
        }
        
        return $this->render('panier/panier.html.twig', [
            'items' => $panierWithData,
            'total' => $total,
            'action' => "assoiffe",
            ]);
        }
        /**
        * @Route("assoiffeur/panier", name="panier_index_assoiffeur")
        */
        public function indexAssoiffeur(SessionInterface $session , ProduitRepository $produitRepository)
        {
            $panier = $session->get('panier', []); // récupération du panier
            
            $panierWithData = [];
            
            foreach($panier as $id => $quantity){
                $panierWithData[]=
                [
                    'produit' => $produitRepository->find($id), //trouver un produit grace à son id
                    'quantity' => $quantity
                ];
                //dump($panierWithData);
                //dd($panierWithData);
            }
            
            // dd($panierWithData);
            
            $total=0;
            foreach($panierWithData as $item){
                $totalItem=$item['produit']->getPrix() * $item['quantity'];
                $total+=$totalItem;
            }
            
            return $this->render('panier/panier.html.twig', [
                'items' => $panierWithData,
                'total' => $total,
                'action' => "assoiffeur",
                ]);
            }
            /**
            * @Route("/panier/add/{id}", name="panier_add")
            */
            public function add($id, SessionInterface $session )
            {
                
                $panier = $session->get('panier', []); // récupération du panier
                if(!empty($panier[$id])){
                    $panier[$id]++;
                }
                else{
                    $panier[$id] = 1;
                }
                
                $session->set('panier', $panier); //fait une mise à jour du panier
                
                return $this->redirectToRoute("panier_index_assoiffe");
                
                //dd($session->get('panier')); //permet de savoir se qu'il y a actuellement dans le panier
            }
            
            /**
            * @Route("/panier/remove/{id}", name="panier_remove")
            */
            public function remove($id, SessionInterface $session)
            {
                $panier = $session->get('panier', []); // récupération du panier
                if(!empty($panier[$id])) {
                    unset($panier[$id]);
                }
                $session->set('panier', $panier);
                return $this->redirectToRoute("panier_index_assoiffe");
            }
        }
