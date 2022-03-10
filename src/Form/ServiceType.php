<?php

namespace App\Form;

use App\Entity\Service;
use App\Entity\CategoryService;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('image', FileType::class, [
                'label' => 'Image',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,
                'attr' => ['class' => 'form-control']

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
            ])
            ->add('des', TextareaType::class, [
                'attr' => ['style' => "height: 167px;", 'class' => 'form-control', 'placeholder' => 'x']
            ])
            ->add('reference', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'x']
            ])
            ->add('price', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'x']
            ])
            ->add('state')
            ->add('name', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'x']
            ])
            ->add('categoryService', EntityType::class, [
                'class' => CategoryService::class,
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control', 'placeholder' => 'x']
            ])
            //->add('quotes')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}
