<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Entity\Stock;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Vich\UploaderBundle\Form\Type\VichImageType;

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
            TextField::new('attachmentFile')->setFormType(VichImageType::class),
            ImageField::new('attachment')->setFormType(ImageField::class)->setBasePath('/uploads/attachments/')->onlyOnIndex(),
            TextField::new('type'),
            AssociationField::new('author'),
            TextField::new('game_character'),
            NumberField::new('price'),

            DateField::new('createdAt'),
            DateField::new('releaseDate'),
            AssociationField::new('category')
            
        ];
    }
    
}
