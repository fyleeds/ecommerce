<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Service\ApiAmiiboService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Faker;

class ProductFixtures extends Fixture
{
    private ApiAmiiboService $apiService;

    public function __construct(ApiAmiiboService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function load(ObjectManager $manager)
    {
        $data = $this->apiService->fetchSpecificAmiibosFromSeries();

        $faker = Faker\Factory::create('fr_FR');

        foreach ($data as $k => $value){
            $category = $this->getReference($value['amiiboSeries']);
            $product = new Product();
            $product->setTitle($value['name']);
            $product->setContent($faker->realText($maxNbChars = 155, $indexSize = 2));
            $product->setPrice($faker->randomFloat(2, 10, 1000));
            // for example, prices between 10 and 1000 with 2 decimals
            $product->setAttachment($value['image']);
            $product->setCreatedAt(date_create($value['release']['eu']));
            $product->setCategory($category);
            $product->setType($value['type']);
            $product->setGameCharacter($value['character']);
            $product->setAuthorId(2);
            $manager->persist($product);
        }

        $manager->flush();
    }
}