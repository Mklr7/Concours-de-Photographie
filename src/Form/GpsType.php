<?php

namespace App\Form;

use App\Entity\Gps;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GpsType extends AbstractType
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
                'label' => 'Vous êtes encore'
                
            ])
            ->add('latitude')
            ->add('longitude')

            ->add('submit', SubmitType::class, [
                'label' => 'Valider  ->',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Gps::class,
            'current_user' => null,

        ]);
    }
}
