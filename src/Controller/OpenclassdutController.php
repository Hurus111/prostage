<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;
use App\Entity\Formation;
use App\Entity\Entreprise;

class OpenclassdutController extends AbstractController
{
    
    public function index(): Response
    {
        // repository stage
        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);

        // ressources bd
        $ressourcesStage = $repositoryStage->findAll();

        // envoyer ressources
        return $this->render('openclassdut/index.html.twig', [
            'ressourcesStage'=>$ressourcesStage
        ]);
    }

    public function entreprises(): Response
    {
        return $this->render('openclassdut/entreprises.html.twig', []);
    }

    public function formations(): Response
    {
        return $this->render('openclassdut/formations.html.twig', []);
    }

    public function stages($id): Response
    {
        // repository stage
        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);

        // ressources bd
        $ressourceStage = $repositoryStage->find($id);

        return $this->render('openclassdut/stages.html.twig', ['ressourceStage'=>$ressourceStage]);
    }

    public function stagesListe(): Response
    {
        // repository stage
        $repositoryStageListe = $this->getDoctrine()->getRepository(Stage::class);

        // ressources bd
        $ressourceStageListe = $repositoryStageListe->findAll();

        // envoyer ressources
        return $this->render('openclassdut/stagesListe.html.twig', ['ressourceStageListe'=>$ressourceStageListe]);
    }
}
