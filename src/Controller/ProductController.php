<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/detail', name: 'app_product')]

    public function index(ProductRepository $productRepository): Response
    {
        $products= $productRepository->findAll();
        return $this->render('product/index.html.twig',['products'=>$products]);
    }
}
