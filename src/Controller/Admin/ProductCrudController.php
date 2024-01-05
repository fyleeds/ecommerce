<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            TextEditorField::new('content'),
            TextField::new('attachment'),
            TextField::new('type'),
            AssociationField::new('author'),
            AssociationField::new('stock')
                ->setLabel('Stock')
                ->setHelp('Select stock for this product'),
            TextField::new('game_character'),
            MoneyField::new('price')
                ->setCurrency('EUR')
                ->setStoredAsCents(true)
                ->setHelp('you need to format your price like this 2088,00 if your product cost 20,88€ '),
            DateField::new('createdAt'),
            DateField::new('releaseDate'),
            AssociationField::new('category')
            
        ];
    }
    
}
