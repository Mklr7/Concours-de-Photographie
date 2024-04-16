<?php

namespace App\Form;

use App\Entity\User;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Range;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'constraints' => new Length([
                    'min' => 2,
                    'max' =>30
                ]),
                'attr' => [
                    'placeholder' => 'Mark',
                    
                ]
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prenom',
                'constraints' => new Length([
                    'min' => 2,
                    'max' =>30
                ]),
                'attr' => [
                    'placeholder' => 'Jean',
                    
                ]
            ])
            ->add('age', IntegerType::class, [ // Ajoutez le champ d'âge
                'label' => 'Age',
                'constraints' => new Range([ // Utilisez Range pour définir des contraintes sur l'âge
                    'min' => 0,
                    'max' => 100, // Par exemple, vous pouvez définir une plage d'âge réaliste
                ]),
                'attr' => [
                    'placeholder' => ' Entrez votre age',
                ],
            ])
            
            
            ->add('email' , EmailType::class , [
                'label' => 'Email',
                'constraints' => new Length([
                    'min' => 2,
                    'max' =>30
                ]),
                'attr' => [
                    'placeholder' => 'exy.gmail.com',
                    
                ]
            ])
             ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Participant' => 'ROLE_PARTICIPANT',
                    'Visiteur' => 'ROLE_VISITOR',
                    
                
                ],
                'mapped' => false, // Ce champ n'est pas mappé à une propriété de l'entité User
                'label' => 'Vous êtes',
                
            ]) 
            ->add('password' , RepeatedType::class , [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identique.',
                'label' => 'Mot de passe',
                'constraints' => new Length([
                    'min' => 2,
                    'max' =>50
                ]),
                'required' =>true,
                'first_options' => ['label' => 'Mot de passe',
                'attr' => [
                    'placeholder' => '°°°°°°'
                ]
            
            ],
                'second_options' => [ 'label' => 'Confirmez votre mot de passe',
                'attr' => [
                    'placeholder' => '°°°°°°',
                    
                ]]
                
            ])
            
            
            ->add('submit', SubmitType::class, [
                'label' => "S'inscrire"
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
