<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\Length;
// use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'required' => true,
                'constraints' => [
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        'max' => 255,
                    ]),
                ],
                'label' => 'Adresse Email'
                ])
            
                
            ->add('roles_users', ChoiceType::class, [
                'required' => true,
                'label' => 'Rôle de l\'utilisateur',
                'choices'  => [
                    'Selectionnez un rôle...' => null,
                    'Équipe technique de Green FIT' => 'ROLE_ADMIN',
                    'Partenaire de Green FIT' => 'ROLE_PARTNER',
                    'Struture de Green FIT' => 'ROLE_STRUCTURE',                    
                ],

            ])
    
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identiques',
                'label' => false,
                'required' => true,
                // 'constraints' => [
                //     new Regex([
                //         'pattern' => '/^(?=.*\d)(?=.*[A-Z])(?=.*[!#$%&*+\/=?^_`{|}~-])(?!.*(.)\1{2}).*[a-z].{8,}$/m',
                //         'match' => true,
                //         'message' => "Votre mot de passe doit comporter au moins huit caractères, dont des lettres majuscules et minuscules, un chiffre et un symbole."
                //     ])
                //     ],
                'first_options' => [
                    'label' => 'Mot de passe',
                    'attr' => [
                        'placeholder' => 'Merci de saisir votre mot de passe'
                    ],
                
                ],
                'second_options' => [
                    'label' => 'Confirmez votre mot de passe',
                    'attr' => [
                        'placeholder' => 'Merci de saisir à nouveau votre mot de passe'
                    ]
                ],
            ])

            ->add('lastname', TextType::class, [
                'required' => true,
                'label' => 'Nom de famille'
            ])

            ->add('firstname', TextType::class, [
                'required' => true,
                'label' => 'Prénom'
            ])

            ->add('address', TextType::class, [
                'required' => true,
                'label' => 'Adresse'
            ])
            
            ->add('zipcode', TextType::class, [
                'required' => true,
                'label' => 'Code postal',
            ])

            ->add('city', TextType::class, [
                'required' => true,
                'label' => 'Ville'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
