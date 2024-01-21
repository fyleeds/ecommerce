<?php

namespace App\Controller;

use App\Service\CartService;
use App\Service\SoldUserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Invoice;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use App\Form\InvoiceFormType;
use Doctrine\ORM\EntityManagerInterface;

class CartValidateController extends AbstractController
{
    #[Route('/cart/validate', name: 'cart_validate_index')]
    public function index(CartService $cartService,SoldUserService $soldUserService,EntityManagerInterface $entityManager,Request $request): Response
    {
        // Get the user object
        $user = $this->getUser();
        if($user){
            $user_id = $user->getId();
            if (!empty($cartService->getCart($user_id))){

                $invoice = new Invoice();
                $invoice->setUser($user);
                $invoice->setDateTransaction(date_create("now"));

                $total_price = $cartService->getTotalPrice($user_id);
                $invoice->setTotalPrice($total_price);

                $form = $this->createForm(InvoiceFormType::class, $invoice);
                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {
                    $invoice = $form->getData();

                    $invoice->setTotalPrice($total_price);
                    dump('totalprice'.$total_price);
                    dump($invoice);
                    $soldUserService->decreaseSold($total_price,$user);
                    $cartService->removeCart($user);
                    
                    $entityManager->persist($invoice);
                    $entityManager->flush();

                    return $this->redirectToRoute('homepage');
                }
            }else{
                $this->addFlash('error','tu ne peux pas valider un panier vide');
                return $this->redirectToRoute('homepage');
            }
        }else{
            return $this->redirectToRoute('app_login');
        }
        return $this->render('cart_validate/index.html.twig', [
            'form' => $form ->createView(),
            'user_id' => $user
        ]);
    }
}
