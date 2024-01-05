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
        $user_id = $user->getId();

        $invoice = new Invoice();
        $invoice->setUser($user);
        $invoice->setDateTransaction(date_create("now"));

        $total_price = $cartService->getTotalPrice($user_id);
        $invoice->setTotalPrice($total_price);

        $form = $this->createForm(InvoiceFormType::class, $invoice);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $invoice = $form->getData();

            $soldUserService->decreaseSold($total_price,$user);
            $cartService->removeCart($user);
            // Persist both Product and Stock
            $entityManager->persist($invoice);
            $entityManager->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('cart_validate/index.html.twig', [
            'form' => $form ->createView(),
        ]);
    }
}
