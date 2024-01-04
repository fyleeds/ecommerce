<?php
// src/Service/CartService.php
namespace App\Service;

use App\Entity\Product;
use App\Entity\User;
use App\Entity\Cart;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class CartService
{
    private RequestStack $requestStack;
    private EntityManagerInterface $em;
    public function __construct(RequestStack $requestStack, EntityManagerInterface $em){

        $this->requestStack = $requestStack;
        $this->em = $em;
    }
    public function addToCart($id,$user):void
    {
        $user_id = $user->getId();
        $cart = $this->em->getRepository(Cart::class)->findOneBy(['user'=>$user_id]);
        $product = $this->em->getRepository(Product::class)->findOneBy(['id'=>$id]);
        $quantity=1;
        if (empty($cart)) {
            $cart = new Cart();
            $cart->addProduct($product);
            $cart->setUser($user);
        }else{
            $products = $cart->getProduct();
            foreach ($products as $product_test) {
                $product_test_id = $product_test->getId();
                if ($product_test_id == $id) {
                    $quantity +=1;
                }
            }
        }
        $cart->addProduct($product);
        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $this->em->persist($cart);
    
        // actually executes the queries (i.e. the INSERT query)
        $this->em->flush();

    }
    public function removeFromCart($id,$user):void
    {
        $user_id = $user->getId();
        $cart = $this->em->getRepository(Cart::class)->findOneBy(['user'=>$user_id]);
        $product = $this->em->getRepository(Product::class)->findOneBy(['id'=>$id]);

        if (!empty($cart)) {
            $cart->removeProduct($product);
        }
        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $this->em->persist($cart);
    
        // actually executes the queries (i.e. the INSERT query)
        $this->em->flush();

    }

    // public function decreaseFromCart(int $id):void
    // {
    //     $cart = $this->getSession()->get("cart",[]);
    //     if ($cart[$id]>1) {
    //         $cart[$id] -= 1;
    //     }
    //     $this->getSession()->set("cart", $cart);

    // }

    public function removeCart($user){
        $user_id = $user->getId();
        $cart = $this->em->getRepository(Cart::class)->findOneBy(['user'=>$user_id]);
        if($cart){
            $this->em->remove($cart);
            $this->em->flush();
        }

    }

    public function getTotal($user)
    {
        $user_id = $user->getId();
        $cart = $this->em->getRepository(Cart::class)->findOneBy(['user'=>$user_id]);
        // $cart_data = [];
        // if ($cart!=null) {
        //     foreach ($cart as $id =>$quantity) {
        //         $product = $this->em->getRepository(Product::class)->findOneBy(['id'=>$id]);
        //         if (!$product) {
                
        //         }
        //         $cart_data[]=[
        //             'product'=> $product,
        //             'quantity'=> $quantity
        //         ];
        //     }
        // }
        $cart = $cart->getProduct();
        return $cart;
        
    }
}