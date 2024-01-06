<?php

namespace App\Controller\Admin;

use App\Entity\CartProduct;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class CartProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CartProduct::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        
        return [
            AssociationField::new('cart'),
            AssociationField::new('product'),
            NumberField::new('quantity'),
            NumberField::new('totalPrice'),

        ];
    }
    
}
