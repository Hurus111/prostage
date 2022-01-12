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
    // ========================================================================= //
    // ===============================  index   ================================ //
    // ========================================================================= //

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

    // ========================================================================= //
    // ============================  entreprises   ============================= //
    // ========================================================================= //

    public function entreprises(): Response
    {
        // repository stage
        $repositoryEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);

        // ressources bd
        $ressourcesEntreprise = $repositoryEntreprise->findAll();

        // envoyer ressources
        return $this->render('openclassdut/entreprises.html.twig', ['ressourcesEntreprise'=>$ressourcesEntreprise]);
    }

    // ========================================================================= //
    // ============================   formations    ============================ //
    // ========================================================================= //

    public function formations(): Response
    {
        // repository stage
        $repositoryFormation = $this->getDoctrine()->getRepository(Formation::class);

        // ressources bd
        $ressourcesFormation = $repositoryFormation->findAll();

        // envoyer ressources
        return $this->render('openclassdut/formations.html.twig', ['ressourcesFormation'=>$ressourcesFormation]);
    }

    // ========================================================================= //
    // ==============================   stages    ============================== //
    // ========================================================================= //

    public function stages($id): Response
    {
        // repository stage
        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);
        //$repositoryEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);
        
        // ressources bd
        $ressourceStage = $repositoryStage->find($id);
        //$ressourceEntreprise = $repositoryEntreprise->find($id);

        return $this->render('openclassdut/stages.html.twig', ['ressourceStage'=>$ressourceStage //,'ressourceEntreprise'=>$ressourceEntreprise
    ]);
    }

    // ========================================================================= //
    // ============================== stagesListe ============================== //
    // ========================================================================= //

    public function stagesListe(): Response
    {
        // repository stage
        $repositoryStageListe = $this->getDoctrine()->getRepository(Stage::class);

        // ressources bd
        $ressourceStageListe = $repositoryStageListe->findAll();

        // envoyer ressources
        return $this->render('openclassdut/stagesListe.html.twig', ['ressourceStageListe'=>$ressourceStageListe]);
    }

    // ========================================================================= //
    // ============================== stagesEntreprise ========================= //
    // ========================================================================= //

    public function stagesEntreprise($id): Response
    {
        // repository stage
        $repositoryStagesEntreprise = $this->getDoctrine()->getRepository(Stage::class);
        $repositoryEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);

        // ressources bd
        $ressourceStagesEntreprise = $repositoryStagesEntreprise->findBy(['entreprise'=>$id]);
        $ressourceEntreprise = $repositoryEntreprise->find($id);

        // envoyer ressources
        return $this->render('openclassdut/stagesEntreprise.html.twig', [
                            'ressourceStagesEntreprise'=>$ressourceStagesEntreprise,
                            'ressourceEntreprise'=>$ressourceEntreprise
                        ]);
    }

    // ========================================================================= //
    // ============================= stagesFiltres ============================= //
    // ========================================================================= //

    public function stagesFiltres($id): Response
    {
        // repository stage
        $repositoryStagesEntreprise = $this->getDoctrine()->getRepository(Stage::class);
        $repositoryEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);

        // ressources bd
        $ressourceStagesEntreprise = $repositoryStagesEntreprise->findBy(['entreprise'=>$id]);
        $ressourceEntreprise = $repositoryEntreprise->find($id);

        // envoyer ressources
        return $this->render('openclassdut/stagesEntreprise.html.twig', [
                            'ressourceStagesEntreprise'=>$ressourceStagesEntreprise,
                            'ressourceEntreprise'=>$ressourceEntreprise
                        ]);
    }
}
