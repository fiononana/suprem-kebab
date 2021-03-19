<?php

namespace App\Controller\Admin;

use App\Entity\Media;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MediaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Media::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Media')
            ->setEntityLabelInPlural('Media')
            ->setSearchFields(['id', 'Nom', 'photo', 'description']);
    }

    public function configureFields(string $pageName): iterable
    {
        $nom = TextField::new('Nom');
        $photo = TextField::new('photo');
        $description = TextField::new('description');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $nom, $photo, $description];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $nom, $photo, $description];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$nom, $photo, $description];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$nom, $photo, $description];
        }
    }
}
