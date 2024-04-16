<?php

namespace App\Form;

use App\Entity\Participant;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipantType extends AbstractType
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
                'label' => 'Vous êtes'
                
            ])
            ->add('attestation', FileType::class, [
                'label' => 'Attestation ou Autorisation'
            ])
            ->add('adresse')
            ->add('ville')
            ->add('codePostal')
            ->add('date')



            ->add('submit', SubmitType::class , [
                'label' => 'Suivant ->',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
            'current_user' => null,
        ]);
    }
}
