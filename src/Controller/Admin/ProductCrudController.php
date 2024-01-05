<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Entity\Stock;
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

    public function createEntity(string $entityFqcn)
    {
        $product = new Product();
        $stock = new Stock();
        $stock->setProduct($product);
        $stock->setQuantity(1);
        $product->setAuthor($this->getUser());
        $product->setStock($stock);

        return $product;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            TextEditorField::new('content'),
            TextField::new('attachment'),
            TextField::new('type'),
            AssociationField::new('author'),
            TextField::new('game_character'),
            MoneyField::new('price')
                ->setCurrency('EUR')
                ->setStoredAsCents(true),
            DateField::new('createdAt'),
            DateField::new('releaseDate'),
            AssociationField::new('category')
            
        ];
    }
    
}
