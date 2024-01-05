<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Stock;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface; 
use App\Entity\Product;

class StockFixtures extends Fixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 4; 
    }
    public function load(ObjectManager $manager)
    {
       
        $products = $manager->getRepository(Product::class)->findAll();
        foreach ($products as $product) {
            if (!$product) {
                continue; // Skip if product is not found
            }

            $stock = new Stock();
            $stock->setProduct($product);
            $stock->setQuantity(rand(1, 10));
            $product->setStock($stock);
            // Set a random quantity between 1 and 10

            $manager->persist($stock);
            $manager->persist($product);
        }

        // Flush to save these entities in the database
        $manager->flush();
    }
}
