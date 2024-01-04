<?php

namespace App\Controller;


use App\Repository\ProductRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/detail/{id<\d+>}', name: 'product_index')]

    public function index(ProductRepository $productRepository, $id): Response
    {
        $id_array = ['id'=>$id];
        $product= $productRepository->findOneBy($id_array);
        return $this->render('product/index.html.twig',['product'=>$product]);
    }
}
