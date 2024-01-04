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
        // Get the user object
        $user = $this->getUser();
        // Check if the user is logged in
        if ($user) {
            $cartService->getTotal();
            return $this->render('cart/index.html.twig',['cart'=>$cartService->getTotal()]);
        }
        return $this->redirectToRoute('app_login');
    }

    #[Route('/cart/add/{id<\d+>}', name: 'cart_add')]
    public function addToCart(CartService $cartService, int $id): Response	
    {
        // Get the user object
        $user = $this->getUser();
        // Check if the user is logged in
        if ($user) {
            $cartService->addToCart($id);
            return $this->redirectToRoute('cart_index');
        }
        return $this->redirectToRoute('app_login');
    }
    #[Route('/cart/decrease/{id<\d+>}', name: 'cart_decrease')]
    public function decreaseFromCart(CartService $cartService, int $id): Response	
    {
        // Get the user object
        $user = $this->getUser();
        // Check if the user is logged in
        if ($user) {
            $cartService->decreaseFromCart($id);
            return $this->redirectToRoute('cart_index');
        }
        return $this->redirectToRoute('app_login');

    }
    #[Route('/cart/removeCart', name: 'removeCart')]
    public function removeCart(CartService $cartService): Response	
    {
        // Get the user object
        $user = $this->getUser();
        // Check if the user is logged in
        if ($user) {
            $cartService->removeCart();
            return $this->redirectToRoute('homepage');
        }
        return $this->redirectToRoute('app_login');
    }
    #[Route('/cart/remove/{id<\d+>}', name: 'cart_remove')]
    public function removeFromCart(CartService $cartService, int $id): Response	
    {
        // Get the user object
        $user = $this->getUser();
        // Check if the user is logged in
        if ($user) {
            $cartService->removeFromCart($id);
            return $this->redirectToRoute('cart_index');
        }
        return $this->redirectToRoute('app_login');
    }
}
