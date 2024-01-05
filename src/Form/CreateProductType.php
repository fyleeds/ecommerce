<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateProductType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
       
        $builder
            ->add('title')
            ->add('content')
            ->add('price', NumberType::class, [])
            ->add('createdAt')
            ->add('attachment')
            ->add('type')
            ->add('game_character')
            ->add('category')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
