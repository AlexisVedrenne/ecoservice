<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Image')
            ->add('Des')
            ->add('Ref')
            ->add('Price')
            ->add('Quantity')
            ->add('State')
            ->add('RecyclingIndex')
            ->add('CategoryPoduct')
            ->add('payments')
            ->add('orderProducts')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
