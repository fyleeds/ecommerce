<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\CategoryShop;
use App\Service\ApiAmiiboService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface; 


class CategoryShopFixtures extends Fixture implements OrderedFixtureInterface
{
    private ApiAmiiboService $apiService;

    public function __construct(ApiAmiiboService $apiService)
    {
        $this->apiService = $apiService;
    }
    public function getOrder()
    {
        return 2; // Load second, after UserFixtures
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