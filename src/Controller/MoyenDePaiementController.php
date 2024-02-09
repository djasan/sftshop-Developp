<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MoyenDePaiementController extends AbstractController
{
    #[Route('/moyen/de/paiement', name: 'app_moyen_de_paiement')]
    public function index(): Response
    {
        return $this->render('moyen_de_paiement/index.html.twig', [
            'controller_name' => 'MoyenDePaiementController',
        ]);
    }
}
