<?php

namespace App\Controller;


use App\Repository\ProductRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CreateProductType;
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
        $user_id = $this->getUser()->getId();
        $product= $productRepository->findOneBy($id_array);
        return $this->render('product/index.html.twig',['product'=>$product,'user_id'=>$user_id]);
    }
    #[Route('/edit/{id<\d+>}', name: 'edit_product')]
    public function edit(EntityManagerInterface $entityManager,Request $request,ProductRepository $productRepository, $id): Response
    {
        $user = $this->getUser();
                    
        $id_array = ['id'=>$id];
        $product= $productRepository->findOneBy($id_array);

        if ($user){

            if ($user->getId() == $product->getAuthor()->getId() ||  $user->getRoles() == ['ROLE_ADMIN']) {

                $form = $this->createForm(CreateProductType::class, $product);

                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {
                    $product = $form->getData();
                    $stock = $product->getStock(); // Get the Stock object from Product

                    // Persist both Product and Stock
                    $entityManager->persist($product);
                    $entityManager->persist($stock);
                    $entityManager->flush();

                    return $this->redirectToRoute('product_index',$id_array);
                }

                return $this->render('product/edit.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
            $message = "Vous n'êtes pas l'auteur du produit ou admin : Aucune action effectuée";
            $this->addFlash('error', $message);
            return $this->redirectToRoute('product_index',$id_array);
        }
    }

}
