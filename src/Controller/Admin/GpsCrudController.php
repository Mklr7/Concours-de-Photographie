<?php

namespace App\Controller\Admin;

use App\Entity\Gps;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GpsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Gps::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('user'),
            TextField::new('latitude'),
            TextField::new('longitude')

        ];
    }
}
