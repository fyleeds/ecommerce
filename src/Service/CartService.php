<?php
// src/Service/CartService.php
namespace App\Service;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    private RequestStack $requestStack;
    private EntityManagerInterface $em;
    public function __construct(RequestStack $requestStack, EntityManagerInterface $em){

        $this->requestStack = $requestStack;
        $this->em = $em;
    }
    public function addToCart(int $id):void
    {
        $cart = $this->getSession()->get("cart",[]);
        if (!empty($cart[$id])) {
            $cart[$id]++;
        }else{
            $cart[$id] = 1;
        }
        $this->getSession()->set("cart", $cart);

    }
    public function removeFromCart(int $id):void
    {
        $cart = $this->getSession()->get("cart",[]);
        if (!empty($cart[$id])) {
            unset($cart[$id]);
        }
        $this->getSession()->set("cart", $cart);

    }

    public function removeCart(){
        return $this->getSession()->remove("cart");
    }

    public function getTotal():array
    {

        $cart = $this->getSession()->get("cart");
        
        $cart_data = [];
        if ($cart!=null) {
            foreach ($cart as $id =>$quantity) {
                $product = $this->em->getRepository(Product::class)->findOneBy(['id'=>$id]);
                if (!$product) {
                
                }
                $cart_data[]=[
                    'product'=> $product,
                    'quantity'=> $quantity
                ];
            }
        }
        return $cart_data;
        
    }
    private function getSession(): SessionInterface
    {
        return $this->requestStack->getSession();
    }
}