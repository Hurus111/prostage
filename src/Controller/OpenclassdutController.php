<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;

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
            //,'controller_name' => 'OpenclassdutController'
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
        return $this->render('openclassdut/stages.html.twig', ['id' => $id]);
    }
}
