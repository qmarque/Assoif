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

class AssoifController extends AbstractController
{
    /**
    * @Route("/", name="assoif")
    */
    public function accueil()
    {
        return $this->render('assoif/index.html.twig', ['controller_name' => 'AssoifController', ]);
    }
    
    # /**
    #* @Route("/assoiffeur", name="assoiffeur_accueil")
    #*/
    # public function accueil_Assoiffeur()
    #  {
        #    return $this->render('assoiffeur/baseassoiffeur.html.twig', ['controller_name' => 'AssoifController', ]);
        #  }
        

        /**
        * @Route("/assoiffe/produit/{id}", name="show_produit_assoiffe")
        */
        public function show_produit_assoiffe(Produit $produit)
        {
            return $this->render('produit/show.html.twig', [
                'produit' => $produit,
                'action' => "assoiffe",
            ]);
        }

        
        /**
        * @Route("/assoiffe/panier", name="panier")
        */
        public function panier()
        {
            return $this->render('assoiffe/panier.html.twig', ['controller_name' => 'AssoifController',]);
        }
        
        
        /**
        * @Route("/assoiffe/panier/payer", name="payment")
        */
        
        public function payment(Request $request, ObjectManager $manager)
        {
            //Création d'une carte bleue vierge qui sera remplie par le formulaire
            $cartebleue = new CarteBleue();
            
            //Création du formulaire permettent de saisir une carte bleue
            
            $formulaireCarteBleue = $this->createForm(CarteBleueType::class, $cartebleue);
            
            /*On demande au formulaire d'analyser la dernière requête Http. Si le tableau POST contenu dans cette requête
            contient des variables nom,activite,adresse,siteweb, alors la méthode handlerequest récupère les valeurs de 
            ces varaibles et les affecte à l'objet entreprise*/
            $formulaireCarteBleue->handleRequest($request);
            
            if ($formulaireCarteBleue->isSubmitted() && $formulaireCarteBleue->isValid())
            {
                /* On ne s'occupe pas du paiement
                // Enregistrer la ressource en base de donnéelse
                $manager->persist($entreprise);
                $manager->flush();
                */
                // Rediriger l'utilisateur vers la page montrant le numméro de commande
                return $this->redirectToRoute('commandeValidee');
            }
            
            //Création de la représentation graphique du formulaire
            $vueFormulaire = $formulaireCarteBleue->createView();
            
            //Afficher la page présentant le formulaire d'ajout d'une carte bleue
            return $this->render('assoiffe/validerCarteBleue.html.twig',['vueFormulaire' => $vueFormulaire, 'action'=>"ajouter"]);
        }

         /**
        * @Route("/assoiffe/panier/payer/valider", name="commandeValidee")
        */
        public function valider()
        {
            return $this->render('assoiffe/commandeValidee.html.twig', ['controller_name' => 'AssoifController',]);
        }
        
    }
