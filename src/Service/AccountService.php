<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Product;
use App\Entity\Invoice;

class AccountService
{
    private EntityManagerInterface $em;
    public function __construct( EntityManagerInterface $em){

        $this->em = $em;
    }

    public function getProductsUser($user)
    {
        $user_id = $user->getId();
        $products_collection=$this->em->getRepository(Product::class)->findBy(['author'=>$user_id]);
        if (!empty($products_collection)) {
            return $products_collection;
        }
        return [];
    }
    public function getInvoicesUser($user)
    {
        $user_id = $user->getId();
        $invoices_collection = $this->em->getRepository(Invoice::class)->findBy(['user'=>$user_id]);
        if (!empty($invoices_collection)) {
            return $invoices_collection;
        }
        return [];
    }

}