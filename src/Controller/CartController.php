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

            return $this->render('cart/index.html.twig',['cart'=>$cartService->getTotalProducts($user),'total_price'=>$cartService->calculateTotalPrice($user), 'userEmail'=> $user]);
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
            if(!empty($cartService->getProduct($id))) {
                $message = $cartService->addToCart($id,$user);
                $this->addFlash('error', $message);
                return $this->redirectToRoute('cart_index');
            }else{
                $this->addFlash('error','Tu ne peux pas ajouter un produit inconnu : Aucun produit ajouté au panier');
                return $this->redirectToRoute('homepage');
            }
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

            if(!empty($cartService->getProduct($id))) {
                $message = $cartService->decreaseFromCart($id,$user);
                $this->addFlash('success', $message);
                return $this->redirectToRoute('cart_index');
            }else{
                $this->addFlash('error','Tu ne peux pas retirer un produit inconnu : Aucune quantité modifié');
                return $this->redirectToRoute('homepage');
            }

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
            $user_id = $user->getId();
            if (!empty($cartService->getCart($user_id))){
                $cartService->removeCart($user);
                $this->addFlash('success','Panier entièrement supprimé ! ');
                return $this->redirectToRoute('homepage');
            }
            $this->addFlash('error','Panier vide ne peut pas être supprimé : Aucun panier supprimé');
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
            if(!empty($cartService->getProduct($id))) {
                $cartService->removeFromCart($id,$user);
                $this->addFlash('success', "Produit retiré du panier");
                return $this->redirectToRoute('cart_index');
            }else{
                $this->addFlash('error','Tu ne peux pas retirer un produit inconnu : Aucun produit retiré du panier');
                return $this->redirectToRoute('homepage');
            }

        }
        return $this->redirectToRoute('app_login');
    }
}
