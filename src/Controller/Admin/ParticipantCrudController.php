<?php

namespace App\Controller\Admin;

use App\Entity\Participant;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField; // Add this import statement
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ParticipantCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Participant::class;
    }

   

    public function configureFields(string $pageName): iterable
    {
        $attestationPath = '/public/attestation';

        return [
            
            AssociationField::new('user'),
            
            TextField::new('attestation')
            ->formatValue(function ($value) {
                if ($value) {
                    $filename = basename($value);
                    return sprintf('<a href="%s" target="_blank">Voir le fichier</a>', $this->generateUrl('app_public_attestation', ['filename' => $filename]));
                } else {
                    return 'Aucun fichier d\'attestation disponible';
                }
            })
            ->setFormTypeOption('attr', ['class' => 'html-field']),
            TextField::new('adresse'),
            TextField::new('ville'),
            TextField::new('code_postal'),
            DateField::new('date'),


        ];
    
    
}
}