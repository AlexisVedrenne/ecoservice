<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\CategoryProduct;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('des', TextareaType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'x', 'style' => "height: 167px;"]
            ])
            ->add('name', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'x']
            ])
            ->add('reference', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'x']
            ])
            ->add('price', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'x']
            ])
            ->add('quantity', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'x']
            ])
            ->add('state')
            ->add('recyclingIndex', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'x']
            ])

            ->add('categoryProduct', EntityType::class, [
                'class' => CategoryProduct::class,
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control', 'placeholder' => 'x']
            ])
            ->add('image', FileType::class, [
                'label' => 'Brochure (PDF file)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,
                'multiple' => true,
                'attr' => ['class' => 'form-control']

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
            ])
            //->add('payments')
            //->add('orderProducts')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
