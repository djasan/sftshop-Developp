<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CouleurController extends AbstractController
{
    #[Route('/couleur', name: 'app_couleur')]
    public function index(): Response
    {
        return $this->render('couleur/index.html.twig', [
            'controller_name' => 'CouleurController',
        ]);
    }
}
