<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Stage;
use App\Entity\Formation;
use App\Entity\Entreprise;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
            $faker = \Faker\Factory::create('fr_FR');

            // ===============
            // FORMATIONS
            // ===============
            $listeFormations=array(
                array("LP Num", "Licence Professionnelle Metiers du Numerique"),
                array("DUT Info", "DUT Informatique"),
                array("LP PA", "Licence Professionnelle Programmation Avancee")
            );

            for($i=0; $i<=2; $i++){
                $formation = new Formation();
            
                $formation->setCode($i);
                $formation->setNomCourt($listeFormations[$i][0]);
                $formation->setNomLong($listeFormations[$i][1]);

                // Création d'un tableau d'entreprises
                $tableauDesFormations[] = $formation;

                $manager->persist($formation);
            }

            // ===============
            // ENTREPRISES
            // ===============
            $listeEntreprises=array(
                "Apple","Facebook", "Discord", 
                "Google", "CDiscount", "Samsung"
            );
            
            for($i=0; $i<20; $i++){
                $randEnt = $listeEntreprises[$faker->numberBetween($min = 0, $max = 5)];
                $entreprise = new Entreprise();

                $entreprise->setNom($randEnt);
                $entreprise->setAdresse($faker->address);
                $entreprise->setActivite($faker->realText($maxNbChars = 50, $indexSize = 2));
                $entreprise->setSiteweb("stage-".$randEnt.".fr");

                
                $tableauDesEntreprises[] = $entreprise;
                $manager->persist($entreprise);
                
            }

            // ===============
            // STAGES
            // ===============
            $titre=array(
                "Developpeur Web","Services Reseaux", 
                "JavaScript", "Programmation Objet", 
                "Symfony", "Gestion de Projet"
            );

            for($i=0; $i<20; $i++){

                $stage = new Stage();
    
                $stage->setCode($i);
                $stage->setTitre($titre[$faker->numberBetween($min = 0, $max = 5)]);
                $stage->setMission($faker->realText($maxNbChars = 300, $indexSize = 2));
                $stage->setEmail($faker->companyEmail);
    
                $entrepriseVersStage = $faker->numberBetween($min = 0, $max = 19);
                $stage->setEntreprise($tableauDesEntreprises[$entrepriseVersStage]);

                $formationVersStage = $faker->numberBetween($min = 0, $max = 2);
                $stage->setFormation($tableauDesFormations[$formationVersStage]);

                $manager->persist($stage);

            }

            $manager->flush();
    }
}
