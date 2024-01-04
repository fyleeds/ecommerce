<?php

namespace App\Controller;


use App\Repository\ProductRepository;
use App\Repository\CategoryShopRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/detail', name: 'app_product')]

    public function index(ProductRepository $productRepository, CategoryShopRepository $categoryShopRepository): Response
    {
        $products= $productRepository->findAll();
        return $this->render('product/index.html.twig',['products'=>$products]);
    }
}
