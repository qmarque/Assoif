<?php

namespace App\DataFixtures;
use App\Entity\Produit;
use App\Entity\TypeProduit;
use App\Entity\Assoiffeur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');
            
        $cidre = new TypeProduit();
        $cidre -> setNom('Cidres');
        $manager->persist($cidre);
        
        $vin = new TypeProduit();
        $vin -> setNom('Vin');
        $manager->persist($vin);
        
        $biere = new TypeProduit();
        $biere -> setNom('Bières');
        $manager->persist($biere);
        
        $sirop = new TypeProduit();
        $sirop -> setNom('Sirops');
        $manager->persist($sirop);
        
        $boissonsRafraichissantes = new TypeProduit();
        $boissonsRafraichissantes -> setNom('Boissons rafraîchissantes');
        $manager->persist($boissonsRafraichissantes);
        
        $cocktail = new TypeProduit();
        $cocktail -> setNom('Cocktails');
        $manager->persist($cocktail);
        
        $boissonsChaudes = new TypeProduit();
        $boissonsChaudes -> setNom('Boissons chaudes');
        $manager->persist($boissonsChaudes);
        
        $digestifs = new TypeProduit();
        $digestifs -> setNom('Digestifs');
        $manager->persist($digestifs);
        
        $tabTypeProduit = array ($biere,$boissonsChaudes,$boissonsRafraichissantes,$cidre,$cocktail,$digestifs,$sirop,$vin);
        
        $Restaurant = new Assoiffeur();
        $Restaurant -> setNom('Chez Philou');
        $Restaurant -> setEmail('chezPhilou@pro.com');
        $Restaurant -> setMdp('philou');
        $Restaurant -> setAdresse($faker->address);
        $Restaurant -> setVille('Pontacq');
        $Restaurant -> setNomGerant('Philou');
        $Restaurant -> setSiegeSocial('EURL');
        $Restaurant -> setSiret(3625218);       
        $Restaurant -> setSiren(362521879);
        $Restaurant -> setLogo('cacahuete');
        $Restaurant -> setPeriodeFermeture($faker->date);
        $manager->persist($Restaurant);
    
        $Bar = new Assoiffeur();
        $Bar -> setNom('Chez Mamailda');
        $Bar -> setEmail('chezMamailda@pro.com');
        $Bar -> setMdp('mamailda');
        $Bar -> setAdresse($faker->address);
        $Bar -> setVille('Pontacq');
        $Bar -> setNomGerant('MamaIlda');
        $Bar -> setSiegeSocial('EURL');
        $Bar -> setSiret(3625217);       
        $Bar -> setSiren(362571879);
        $Bar -> setLogo('prune');
        $Bar -> setPeriodeFermeture($faker->date);
        $manager->persist($Bar);

        $tabAssoiffeur= array ($Restaurant,$Bar);
        
        if (($handle = fopen(dirname(__FILE__)."\boissons.csv", "r")) !== FALSE) {
            $row = fgets($handle);
            
            for($i=0;$i<150;$i++){
                
                $row = fgets($handle);
                $produit = explode("\t", $row);
                if(!(empty($produit[6]) || empty($produit[7]) || empty($produit[50]))){
                    $Unproduit[$i] = new Produit();
                    $Unproduit[$i]->setNom($produit[6]);
                    $Unproduit[$i]->setPrix(random_int(3,8));
                    $Unproduit[$i]->setDosage($produit[7]);
                    $Unproduit[$i]->setPhoto($produit[50]);
                    $Unproduit[$i]->setStock(random_int(10,150));
                    //Définir et mettre à jour le produit
                    // Sélectionner un type de produit au hasard parmi les 8 enregistrées dans $tabTypeProduit
                    $choixTypeProduit = $faker->numberBetween($min = 0,$max = 7);
                    // Création relation Produit --> TypeProduit
                    $Unproduit[$i] -> setTypeProduit($tabTypeProduit[$choixTypeProduit]);
                    // Création relation TypeProduit --> Produit
                    $tabTypeProduit[$choixTypeProduit] -> addProduit($Unproduit[$i]);
                    // Persister les objets modifiés
                    $manager->persist($tabTypeProduit[$choixTypeProduit]);                    
                    $manager->persist($Unproduit[$i]);
                    // Sélectionner un type d'assoiffeur au hasard parmi les 2 enregistrées dans $tabAssoiffeur
                    $choixAssoiffeur = $faker->numberBetween($min = 0,$max = 1);
                    // Création relation Produit --> assoiffeur
                    $Unproduit[$i] -> addAssoiffeur($tabAssoiffeur[$choixAssoiffeur]);
                    // Création relation assoiffeur --> Produit
                    $tabAssoiffeur[$choixAssoiffeur] -> addProduit($Unproduit[$i]);
                    // Persister les objets modifiés
                    $manager->persist($tabAssoiffeur[$choixAssoiffeur]);                    
                    $manager->persist($Unproduit[$i]);
                    
                }
                
            }
            fclose($handle);
        }
        $manager->flush();
    }
    
    
    
    
    
}
