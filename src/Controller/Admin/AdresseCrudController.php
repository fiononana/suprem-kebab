<?php

namespace App\Controller\Admin;

use App\Entity\Adresse;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AdresseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Adresse::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Adresse')
            ->setEntityLabelInPlural('Adresse')
            ->setSearchFields(['id', 'adresse', 'contact', 'facebook', 'instagram']);
    }

    public function configureFields(string $pageName): iterable
    {
        $adresse = TextField::new('adresse');
        $contact = TextField::new('contact');
        $facebook = TextField::new('facebook');
        $instagram = TextField::new('instagram');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $adresse, $contact, $facebook, $instagram];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $adresse, $contact, $facebook, $instagram];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$adresse, $contact, $facebook, $instagram];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$adresse, $contact, $facebook, $instagram];
        }
    }
}
