<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Photo;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\SlugType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('user', EntityType::class, [
            'class' => User::class,
            'choices' => [$options['current_user']], // Limiter aux utilisateurs actuels
            'choice_label' => function($user) {
                // Concaténer le nom et le prénom de l'utilisateur
                return $user->getNom() . ' ' . $user->getPrenom();
            },
            'label' => 'Vous êtes toujour'
            
        ])
            ->add('nom', TextType::class, [
                'label' => 'Nom de l\'image'
            ])
            ->add('slug', HiddenType::class, [
                'mapped' => false, // Ne pas mapper le champ à l'entité Participant
            ])
            ->add('illustration', FileType::class)
            ->add('description')
            ->add('date')
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'nom',
            ])
           

            ->add('submit', SubmitType::class , [
                'label' => 'Suivant ->',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Photo::class,
            'current_user' => null,
        ]);
    }
}
