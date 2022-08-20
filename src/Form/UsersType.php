<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => 'Adresse Email'
            ])
            ->add('password')
            ->add('roles', ChoiceType::class, [
                'required' => true,
                'choices'  => [
                    'Selectionnez un rôle...' => null,
                    'Équipe technique de Green FIT' => 'ROLE_ADMIN',
                    'Partenaire de Green FIT' => 'ROLE_PARTNER',
                    'Struture de Green FIT' => 'ROLE_STRUCTURE',                    
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
                'attr' => ['pattern' => '/^[0-9]{8}$/', 'maxlength' => 5]
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
