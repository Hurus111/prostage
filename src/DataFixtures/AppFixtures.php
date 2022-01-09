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
      
        $formations=array(
                        array("LP Num", "Licence Professionnelle Metiers du Numerique"),
                        array("DUT Info", "DUT Informatique"),
                        array("LP PA", "Licence Professionnelle Programmation Avancee")
                );
        
        $TABMAX = 5;
        $titre=array("Developpeur Web",
                    "Services Reseaux", 
                    "JavaScript", 
                    "Programmation Objet", 
                    "Symfony", 
                    "Gestion de Projet"
                );
        $nomEntrep=array("Apple",
                        "Facebook", 
                        "Discord", 
                        "Google", 
                        "CDiscount", 
                        "Samsung"
                );

        for($i=1; $i<=20; $i++){

            // ===============
            // STAGES
            // ===============

            ${"stage".$i} = new Stage();

            ${"stage".$i}->setCode($i);
            ${"stage".$i}->setTitre($titre[$faker->numberBetween($min = 0, $max = $TABMAX)]);
            ${"stage".$i}->setMission($faker->realText($maxNbChars = 300, $indexSize = 2));
            ${"stage".$i}->setEmail($faker->companyEmail);

            $manager->persist(${"stage".$i});

            // ===============
            // FORMATIONS
            // ===============
            $randForm = $faker->numberBetween($min = 0, $max = 2);

            ${"formation".$i} = new Formation();
            
            ${"formation".$i}->setCode($i);
            ${"formation".$i}->setNomCourt($formations[$randForm][0]);
            ${"formation".$i}->setNomLong($formations[$randForm][1]);

            ${"formation".$i}->addStage(${"stage".$i});

            $manager->persist(${"formation".$i});
            
            // ===============
            // ENTREPRISES
            // ===============
            $randEnt = $nomEntrep[$faker->numberBetween($min = 0, $max = $TABMAX)];
            ${"enteprise".$i} = new Entreprise();

            ${"enteprise".$i}->setCode($i);
            ${"enteprise".$i}->setNom($randEnt);
            ${"enteprise".$i}->setAdresse($faker->address);
            ${"enteprise".$i}->setActivite($faker->realText($maxNbChars = 100, $indexSize = 2));
            ${"enteprise".$i}->setSiteweb("stage-".$randEnt.".fr");

            ${"enteprise".$i}->addStage(${"stage".$i});

            $manager->persist(${"enteprise".$i});
        }

        $manager->flush();

        // ===============
        // FORMATIONS
        // ===============
        /*$i=0;
        $formations=array(
                        array("LP Num", "Licence Professionnelle Metiers du Numerique"),
                        array("DUT Info", "DUT Informatique"),
                        array("LP PA", "Licence Professionnelle Programmation Avancee")
                );

        foreach($formations as $court => $long){
            $i++;
            ${"formation".$i} = new Formation();
            
            ${"formation".$i}->setCode($i);
            ${"formation".$i}->setNomCourt($court);
            ${"formation".$i}->setNomLong($long);
            $manager->persist(${"formation".$i});

            $manager->flush();
        }*/
    
        // ===============
        // ENTREPRISES
        // ===============

        
        /*
        for($i=1; $i<=20; $i++){
            ${"enteprise".$i} = new Entreprise();

            ${"enteprise".$i}->setCode($i);
            ${"enteprise".$i}->setNom($faker->name);
            ${"enteprise".$i}->setAdresse($faker->address);
            ${"enteprise".$i}->setActivite($faker->realText($maxNbChars = 100, $indexSize = 2));
            ${"enteprise".$i}->setSiteweb($faker->domainName);
            $manager->persist(${"enteprise".$i});

            $manager->flush();
        }*/
    }
}
