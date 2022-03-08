<?php

namespace App\Form;

use App\Entity\Service;
use App\Entity\CategoryService;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('image')
            ->add('des')
            ->add('reference')
            ->add('price')
            ->add('state')
            ->add('categoryService', EntityType::class, [
                'class' => CategoryService::class,
                'choice_label' => 'name',
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
