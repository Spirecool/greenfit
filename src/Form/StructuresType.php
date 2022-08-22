<?php

namespace App\Form;

use App\Entity\Modules;
use App\Entity\Structures;
use App\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StructuresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('is_active')
            ->add('slug')
            ->add('users', PersonType::class, [
                'data_class' => Users::class, 
            ])
            ->add('name')
            ->add('modules', EntityType::class, [
                'required' => true,
                'label' => 'Rôle de l\'utilisateur',
                'class' => Modules::class,
                'multiple' => true,
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Structures::class,
        ]);
    }
}
