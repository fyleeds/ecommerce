<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Stock;
use App\Form\CreateProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class SellController extends AbstractController
{

    #[Route('/sell', name: 'sell_index')]
    public function createProduct(Request $request, EntityManagerInterface $entityManager): Response
    {

        // Get the user object
        $user = $this->getUser();

        // Check if the user is logged in
        if ($user) {
            $product = new Product();
            $stock = new Stock();

            $product->setAuthor($user);
            $product->setReleaseDate(new \DateTime());
            $product->setStock($stock);
     
            $form = $this->createForm(CreateProductType::class, $product);
     
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $product = $form->getData();
                
                $stock = $stock->setProduct($product);

                // Persist both Product and Stock
                $entityManager->persist($product);
                $entityManager->persist($stock);
                $entityManager->flush();

                return $this->redirectToRoute('homepage');
            }
     
            return $this->render('sell/index.html.twig', [
                'form' => $form ->createView(),
                'userEmail' => $user
            ]);
 
        }

        return $this->redirectToRoute('app_login');
        
    }

}
