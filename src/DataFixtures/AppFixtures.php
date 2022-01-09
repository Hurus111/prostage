<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Stage;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');
               
        // ===============
        // STAGES
        // ===============
      
        $TABMAX = 5;
        $titre=array("Developpeur Web", "Services Reseaux", "JavaScript", "Programmation Objet", "Symfony", "Gestion de Projet");

        for($i=1; $i<=10; $i++){
            ${"stage".$i} = new Stage();

            ${"stage".$i}->setCode($i);
            ${"stage".$i}->setTitre($titre[$faker->numberBetween($min = 0, $max = $TABMAX)]);
            ${"stage".$i}->setMission($faker->realText($maxNbChars = 300, $indexSize = 2));
            ${"stage".$i}->setEmail($faker->companyEmail);
            $manager->persist(${"stage".$i});

            $manager->flush();
        }
        // ===============
        // ENTREPRISES
        // ===============

        for($i=1; $i<=10; $i++){
            ${"enteprise".$i} = new Stage();

            ${"enteprise".$i}->setCode($i);
            ${"enteprise".$i}->setTitre($titre[$faker->numberBetween($min = 0, $max = $TABMAX)]);
            ${"enteprise".$i}->setMission($faker->realText($maxNbChars = 300, $indexSize = 2));
            ${"enteprise".$i}->setEmail($faker->companyEmail);
            $manager->persist(${"enteprise".$i});

            $manager->flush();
        }
    
        // ===============
        // FORMATIONS
        // ===============

        for($i=1; $i<=10; $i++){
            ${"stage".$i} = new Stage();

            ${"stage".$i}->setCode($i);
            ${"stage".$i}->setTitre($titre[$faker->numberBetween($min = 0, $max = $TABMAX)]);
            ${"stage".$i}->setMission($faker->realText($maxNbChars = 300, $indexSize = 2));
            ${"stage".$i}->setEmail($faker->companyEmail);
            $manager->persist(${"stage".$i});

            $manager->flush();
        }
    }
}
