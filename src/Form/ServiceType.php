<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add("type d'equipement", EntityType::class, [
                'class' => CategoryProduct::class,
                'choice_label' => 'name',])

            ->add('Equipement', EntityType::class,[
                'class' => Product::class
            ])
            ->add('Quantité')
            
            ->add('Poids')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
