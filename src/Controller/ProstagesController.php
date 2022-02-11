<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;
use App\Entity\Formation;
use App\Entity\Entreprise;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;


class ProstagesController extends AbstractController
{
    // ========================================================================= //
    // ===============================  index   ================================ //
    // ========================================================================= //

    public function index(): Response
    {
        // repository stage
        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);
        $repositoryEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);

        // ressources bd
        $ressourcesStage = $repositoryStage->findBy(array(),array('id'=>'DESC'),4,0);
        $ressourcesEntreprise = $repositoryEntreprise->findBy(array(),array('id'=>'DESC'),4,0);

        // envoyer ressources
        return $this->render('prostages/index.html.twig', [
            'ressourcesStage'=>$ressourcesStage,
            'ressourcesEntreprise'=>$ressourcesEntreprise
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
        return $this->render('prostages/entreprises.html.twig', ['ressourcesEntreprise'=>$ressourcesEntreprise]);
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
        return $this->render('prostages/formations.html.twig', ['ressourcesFormation'=>$ressourcesFormation]);
    }

    // ========================================================================= //
    // ==============================   stages    ============================== //
    // ========================================================================= //

    public function stages($id): Response
    {
        // repository stage
        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);
        
        // ressources bd
        $ressourceStage = $repositoryStage->find($id);

        return $this->render('prostages/stages.html.twig', ['ressourceStage'=>$ressourceStage //,'ressourceEntreprise'=>$ressourceEntreprise
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
        return $this->render('prostages/stagesListe.html.twig', ['ressourceStageListe'=>$ressourceStageListe]);
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
        return $this->render('prostages/stagesEntreprise.html.twig', [
                            'ressourceStagesEntreprise'=>$ressourceStagesEntreprise,
                            'ressourceEntreprise'=>$ressourceEntreprise
                        ]);
    }

    // ========================================================================= //
    // ============================== stagesFormation ========================= //
    // ========================================================================= //

    public function stagesFormation($id): Response
    {
        // repository stage
        $repositoryStagesFormation = $this->getDoctrine()->getRepository(Stage::class);
        $repositoryFormation = $this->getDoctrine()->getRepository(Formation::class);

        // ressources bd
        $ressourceStagesFormation = $repositoryStagesFormation->findBy(['formation'=>$id]);
        $ressourceFormation = $repositoryFormation->find($id);

        // envoyer ressources
        return $this->render('prostages/stagesFormation.html.twig', [
                            'ressourceStagesFormation'=>$ressourceStagesFormation,
                            'ressourceFormation'=>$ressourceFormation
                        ]);
    }



    // ========================================================================= //
    // ============================== tps_s4 =================================== //
    // ========================================================================= //

    public function parEntreprise($id){
        $repository = $this->getDoctrine()->getRepository(Stage::class);

        $stage = $repository->stagesParEntreprise($id);

        return $this->render('tps_s4/parEntreprise.html.twig',
            ['stage'=>$stage]
        );
    }

    public function parFormation($nom){
        $repository = $this->getDoctrine()->getRepository(Stage::class);

        $stage = $repository->stagesParFormation($nom);

        return $this->render('tps_s4/parFormation.html.twig',
            ['stage'=>$stage]
        );
    }

    // ========================================================================= //
    // ============================== ajouterEntreprise ======================== //
    // ========================================================================= //

    public function ajouterEntreprise(Request $request, EntityManagerInterface $manager){
        $entreprise = new Entreprise();

        $formulaireEntreprise = $this->createFormBuilder($entreprise)
                            ->add('nom')
                            ->add('activite')
                            ->add('adresse')
                            ->add('siteweb')
                            ->getForm();

        $formulaireEntreprise->handleRequest($request);

        if($formulaireEntreprise->isSubmitted()){

            $manager->persist($entreprise);
            $manager->flush();

            return $this->redirectToRoute('prostages_accueil');
        }

        return $this->render('prostages/ajouterEntreprise.html.twig',
            ['ressourceFormulaire'=>$formulaireEntreprise->createView()]
        );
    }

    // ========================================================================= //
    // ============================== modifierEntreprise ======================== //
    // ========================================================================= //

    public function modifierEntreprise(Request $request, EntityManagerInterface $manager, Entreprise $entreprise){

        $formulaireEntreprise = $this->createFormBuilder($entreprise)
                            ->add('nom')
                            ->add('activite')
                            ->add('adresse')
                            ->add('siteweb')
                            ->getForm();

        $formulaireEntreprise->handleRequest($request);

        if($formulaireEntreprise->isSubmitted()){

            $manager->persist($entreprise);
            $manager->flush();

            return $this->redirectToRoute('prostages_accueil');
        }

        return $this->render('prostages/modifierEntreprise.html.twig',
            ['ressourceFormulaire'=>$formulaireEntreprise->createView()]
        );
    }
    
}
