<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VitrineController extends AbstractController
{
    #[Route('/vitrine', name: 'vitrine')]
    public function index(): Response
    {
        return $this->render('vitrine/index.html.twig', [
            'controller_name' => 'VitrineController',
        ]);
    }
    #[Route('/specialite', name: 'specialite')]
    public function specialite(): Response
    {
        return $this->render('vitrine/specialite.html.twig', [
            'controller_name' => 'VitrineController',
        ]);
    }

    #[Route('/galerie', name: 'galerie')]
    public function galerie(): Response
    {
        return $this->render('vitrine/galerie.html.twig', [
            'controller_name' => 'VitrineController',
        ]);
    }
    #[Route('/menu', name: 'menu')]
    public function menu(): Response
    {
        return $this->render('vitrine/menu.html.twig', [
            'controller_name' => 'VitrineController',
        ]);
    }


}
