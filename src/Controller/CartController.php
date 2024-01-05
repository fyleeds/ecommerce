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

            return $this->render('cart/index.html.twig',['cart'=>$cartService->getTotalProducts($user),'total_price'=>$cartService->calculateTotalPrice($user)]);
        }
        return $this->redirectToRoute('app_login');
    }

    #[Route('/cart/add/{id<\d+>}', name: 'cart_add')]
    public function addToCart(CartService $cartService,int $id): Response	
    {
        // Get the user object
        $user = $this->getUser();
        // Check if the user is logged in
        if ($user) {
            $message = $cartService->addToCart($id,$user);
            $this->addFlash('error', $message);
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
            $cartService->decreaseFromCart($id,$user);
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
            $cartService->removeCart($user);
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
            $cartService->removeFromCart($id,$user);
            return $this->redirectToRoute('cart_index');
        }
        return $this->redirectToRoute('app_login');
    }
}
