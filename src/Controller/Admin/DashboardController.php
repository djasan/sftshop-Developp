<?php

namespace App\Controller\Admin;

use App\Entity\Catalogue;
use App\Entity\User;
use App\Entity\Paiement;
use App\Entity\Taille;
use App\Entity\Couleur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setFaviconPath('assets/images/icons/favicon.ico')
            ->setTitle('TShop');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Accueil', 'fa fa-home', 'app_home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
    }
}
