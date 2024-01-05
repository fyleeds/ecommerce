<?php

namespace App\Controller;


use App\Repository\ProductRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Product;
use App\Entity\Stock;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/detail/{id<\d+>}', name: 'product_index', methods: ['GET'])]

    public function index(ProductRepository $productRepository, $id): Response
    {
        $id_array = ['id'=>$id];
        $product= $productRepository->findOneBy($id_array);
        return $this->render('product/index.html.twig',['product'=>$product]);
    }
    #[Route('/edit', name: 'edit_product')]
    public function edit(ProductRepository $productRepository, $id): Response
    {
        $user = $this->getUser();
                    
        $id_array = ['id'=>$id];
        $product= $productRepository->findOneBy($id_array);

        if ($user){

            if ($user->getId() == $product->getAuthor() ||  $user->getRoles()){
                return $this->render('edit/edit.html.twig', [
                    // Pass necessary data to your template
                ]);
            }
            $message = "Vous n'êtes pas l'auteur de l'article ou admin : Aucune action effectuée";
            $this->addFlash('error', $message);
            return $this->redirectToRoute('product_index',$id_array);
        }
    }

}
