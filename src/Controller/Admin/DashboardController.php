<?php

namespace App\Controller\Admin;

use App\Entity\Adresse;
use App\Entity\Media;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('EasyAdmin');
    }

    public function configureCrud(): Crud
    {
        return Crud::new();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Media', 'fas fa-folder-open', Media::class);
        yield MenuItem::linkToCrud('Adresse', 'fas fa-folder-open', Adresse::class);
        yield MenuItem::linkToCrud('User', 'fas fa-folder-open', User::class);
    }
}
