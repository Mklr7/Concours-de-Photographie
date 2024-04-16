<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'disabled' => true,
                'label' => 'Email'
            ])
            ->add('nom', TextType::class , [
                'disabled' => true,
                'label' => 'Nom'
            ])
            ->add('prenom', TextType::class, [
                'disabled' => true,
                'label' => 'Prenom'
            ])
            ->add('age' , IntegerType::class , [
                'disabled' => true,
                'label' => 'Age'
            ])
            ->add('old_password', PasswordType::class, [
                'label' => "Mon mot de passe actuel",
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Veuillez saisir votre mot de passe actuel'
                ]

            ])
            ->add('new_password' , RepeatedType::class , [
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identique.',
                'label' => 'Mon nouveau mot de passe',
                'constraints' => new Length([
                    'min' => 2,
                    'max' =>50
                ]),
                'required' =>true,
                'first_options' => ['label' => 'Mon nouveau mot de passe',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre nouveau mot de passe.'
                ]
            
            ],
                'second_options' => [ 'label' => 'Merci de confirmez votre nouveau mot de passe',
                'attr' => [
                    'placeholder' => '°°°°°°',
                    
                ]]
                
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Modifier mon mot de passe "
            ])
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
