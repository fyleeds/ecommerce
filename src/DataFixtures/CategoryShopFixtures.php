<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\CategoryShop;
use App\Service\ApiAmiiboService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryShopFixtures extends Fixture
{
    private ApiAmiiboService $apiService;

    public function __construct(ApiAmiiboService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function load(ObjectManager $manager)
    {
        $data = $this->apiService->fetchAmiiboseries();

        foreach ($data as $k => $value){
            $categoryshop = new CategoryShop();
            $categoryshop->setName($value['name']);
            $manager->persist($categoryshop);
            $this->addReference($value['name'], $categoryshop);
        }

        $manager->flush();
    }
}