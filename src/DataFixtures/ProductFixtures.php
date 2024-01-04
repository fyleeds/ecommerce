<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\User;
use App\Service\ApiAmiiboService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface; 
use Faker;

class ProductFixtures extends Fixture implements OrderedFixtureInterface
{
    private ApiAmiiboService $apiService;

    public function __construct(ApiAmiiboService $apiService)
    {
        $this->apiService = $apiService;

    }

    public function getOrder()
    {
        return 3; // Load second, after UserFixtures
    }

    public function load( ObjectManager $manager)
    {
        $data = $this->apiService->fetchSpecificAmiibosFromSeries();

        $faker = Faker\Factory::create('fr_FR');

        foreach ($data as $k => $value){
            $category = $this->getReference($value['amiiboSeries']);
            $authors = $manager->getRepository(User::class)->findAll();
            $product = new Product();
            $product->setTitle($value['name']);
            $product->setContent($faker->realText($maxNbChars = 155, $indexSize = 2));
            $product->setPrice($faker->randomFloat(2, 10, 1000));
            // for example, prices between 10 and 1000 with 2 decimals
            $product->setAttachment($value['image']);
            $product->setCreatedAt(date_create("now"));
            $product->setReleaseDate(date_create($value['release']['eu']));
            $product->setCategory($category);
            $product->setType($value['type']);
            $product->setGameCharacter($value['character']);
            $product->setAuthor($authors[0]);
            $manager->persist($product);
        }

        $manager->flush();
    }
}