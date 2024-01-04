<?php

namespace App\Controller;

use App\Entity\Product;
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
            $product->setAuthor($user);
            $product->setReleaseDate(new \DateTime());
     
            $form = $this->createForm(CreateProductType::class, $product);
     
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                 // $form->getData() holds the submitted values
                 // but, the original `$task` variable has also been updated
                $product= $form->getData();
     
                 // // tell Doctrine you want to (eventually) save the Product (no queries yet)
                $entityManager->persist($product);
     
                 // // actually executes the queries (i.e. the INSERT query)
                $entityManager->flush();
     
                 // return new Response('Saved new product with id '.$product->getId());
     
                return $this->redirectToRoute('homepage');
            }
     
            return $this->render('sell/index.html.twig', [
                'form' => $form ->createView(),
            ]);
 
             // ... Do something with $userId
        }

        return $this->redirectToRoute('app_login');
        
    }

}
