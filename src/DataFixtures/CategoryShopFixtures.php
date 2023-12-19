<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\CategoryShop;
use App\Controller\ApiCallController;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryShopFixtures extends Fixture
{
    private ApiCallController $apiService;

    public function __construct(ApiCallController $apiService)
    {
        $this->apiService = $apiService;
    }

    public function load(ObjectManager $manager)
    {
        $data = $this->apiService->fetchAmiiboseries();
        // create 20 products! Bam!
        foreach ($data as $k => $value){
            $categoryshop = new CategoryShop();
            $categoryshop->setName($value['name']);
            $manager->persist($categoryshop);
        }

        $manager->flush();
    }
}