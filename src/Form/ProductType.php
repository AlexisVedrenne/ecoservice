<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\CategoryProduct;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('image')
            ->add('des')
            ->add('reference')
            ->add('price')
            ->add('quantity')
            ->add('state')
            ->add('recyclingIndex')

            ->add('categoryProduct', EntityType::class, [
                'class' => CategoryProduct::class,
                'choice_label' => 'name',
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
