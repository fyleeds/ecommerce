<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class CreateProductType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
       
        $builder
            ->add('title')
            ->add('content')
            ->add('price', NumberType::class, [])
            ->add('releaseDate', DateType::class, [
                'label' => 'Release Date'
            ])
            ->add('attachmentFile', VichFileType::class, [
                'required' => false,
                'label' => 'Product Attachment',
            ])
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
