<?php

namespace App\Form;

use App\Entity\Quote;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Service;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class QuoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameProfessional', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'x']
            ])
            ->add('mail', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'x']
            ])
            ->add('numero', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'x']
            ])
            ->add('city', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'x']
            ])
            ->add('societe', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'x']
            ])
            ->add('des', TextareaType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'x', 'style' => "height: 167px;"]
            ])
            ->add('service', EntityType::class, [
                'class' => Service::class,
                'required' => true,
                'multiple' => true,
                'expanded' => true,
                'choice_label' => 'name',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Quote::class,
        ]);
    }
}
