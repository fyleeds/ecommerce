<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Form\DataTransformer\PriceTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateProductType extends AbstractType
{
    private $transformer;

    public function __construct(PriceTransformer $transformer)
    {
        $this->transformer = $transformer;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
       
        $builder
            ->add('title')
            ->add('content')
            ->add($builder->create('price', TextType::class)
                        ->addModelTransformer($this->transformer))
            ->add('stock', StockType::class, [
                'label' => false,
            ])
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
