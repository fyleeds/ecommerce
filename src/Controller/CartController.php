<?php

namespace App\Controller;

use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{

    #[Route('/cart', name: 'cart_index')]
    public function index(CartService $cartService): Response	
    {
        $cartService->getTotal();
        return $this->render('cart/index.html.twig',['cart'=>$cartService->getTotal()]);
    }

    #[Route('/cart/add/{id<\d+>}', name: 'cart_add')]
    public function addToRoute(CartService $cartService, int $id): Response	
    {
        $cartService->addToCart($id);
        return $this->redirectToRoute('cart_index');
    }
    #[Route('/cart/removeAll', name: 'removeAll')]
    public function removeAll(CartService $cartService): Response	
    {
        $cartService->removeCart();
        return $this->redirectToRoute('homepage');
    }
}
