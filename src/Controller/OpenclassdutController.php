<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OpenclassdutController extends AbstractController
{

    public function index(): Response
    {
        return $this->render('openclassdut/index.html.twig', [
            'controller_name' => 'OpenclassdutController',
        ]);
    }

    public function entreprises(): Response
    {
        return $this->render('openclassdut/entreprises.html.twig', []);
    }
}
