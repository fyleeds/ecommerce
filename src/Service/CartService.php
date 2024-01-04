<?php
// src/Service/CartService.php
namespace App\Service;

use App\Entity\CartProduct;
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
        $cart_user = $this->em->getRepository(Cart::class)->findOneBy(['user'=>$user_id]);
        if (empty($cart_user)) {
            $cart_user = new Cart();
            $cart_user->setUser($user);
            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $this->em->persist($cart_user);
        
            // actually executes the queries (i.e. the INSERT query)
            $this->em->flush();
        }

        $cart_user_id = $cart_user->getId();

        $product = $this->em->getRepository(Product::class)->findOneBy(['id'=>$id]);
        $carts_product = $this->em->getRepository(CartProduct::class)->findBy(['cart' => $cart_user_id]);

        if (empty($carts_product)) {
            $carts_product = new CartProduct();
            $carts_product->setProduct($product);
            $carts_product->setCart( $cart_user);
            $carts_product->setQuantity(1);
            $this->em->persist($carts_product);

        }else{
            $isQuantityModified = false;

            foreach ($carts_product as $cart_product) {
                $product_cart = $cart_product->getProduct();
                if ($product_cart->getId() == $id) {
                    $quantity = $cart_product->getQuantity();
                    $cart_product->setQuantity($quantity + 1);
                    $this->em->persist($cart_product);
                    $isQuantityModified = true;
                    break; // Exit the loop once the product is found and updated
                }
            }

            if (!$isQuantityModified) {
                $newCartProduct = new CartProduct();
                $newCartProduct->setProduct($product);
                $newCartProduct->setCart($cart_user);
                $newCartProduct->setQuantity(1);
                $this->em->persist($newCartProduct);
            }

        }

        $this->em->flush(); // Flush outside the loop to apply all changes

    }
    public function decreaseFromCart($id,$user):void
    {
        $user_id = $user->getId();
        $cart_user = $this->em->getRepository(Cart::class)->findOneBy(['user'=>$user_id]);
        if (!empty($cart_user)) {

            $cart_user_id = $cart_user->getId();

            $product = $this->em->getRepository(Product::class)->findOneBy(['id'=>$id]);
            $carts_product = $this->em->getRepository(CartProduct::class)->findBy(['cart' => $cart_user_id]);

            if (!empty($carts_product)) {

                foreach ($carts_product as $cart_product) {
                    $product_cart = $cart_product->getProduct();
                    if ($product_cart->getId() == $id) {
                        $quantity = $cart_product->getQuantity();
                        if ($quantity >1) {
                            $cart_product->setQuantity($quantity - 1);
                            $this->em->persist($cart_product);
                            $this->em->flush();
                            break; // Exit the loop once the product is found and updated
                        }
                    }
                }
            }

        }

    }
    public function removeFromCart($id,$user):void
    {
        $user_id = $user->getId();
        $cart_user = $this->em->getRepository(Cart::class)->findOneBy(['user'=>$user_id]);
        if (!empty($cart_user)) {

            $cart_user_id = $cart_user->getId();

            $product = $this->em->getRepository(Product::class)->findOneBy(['id'=>$id]);
            $carts_product = $this->em->getRepository(CartProduct::class)->findBy(['cart' => $cart_user_id]);

            if (!empty($carts_product)) {

                
                foreach ($carts_product as $cart_product) {
                    $product_cart = $cart_product->getProduct();
                    if ($product_cart->getId() == $id) {
                        $this->em->remove($cart_product);
                        $this->em->flush(); // Flush outside the loop to apply all changes
                        break; // Exit the loop once the product is found and updated
                    }
                }

            }
        }

    }


    public function removeCart($user){
        $user_id = $user->getId();
        $cart_user = $this->em->getRepository(Cart::class)->findOneBy(['user' => $user_id]);
    
        if ($cart_user) {
            $cart_user_id = $cart_user->getId();
            $carts_product = $this->em->getRepository(CartProduct::class)->findBy(['cart' => $cart_user_id]);
    
            // Remove each CartProduct individually
            foreach ($carts_product as $cart_product) {
                $this->em->remove($cart_product);
            }
    
            // After removing all CartProducts, remove the Cart
            $this->em->remove($cart_user);
            $this->em->flush();
        }
    }
    

    public function getTotal($user)
    {
        $user_id = $user->getId();
        $cart_user = $this->em->getRepository(Cart::class)->findOneBy(['user'=>$user_id]);
        if (!empty($cart_user)) {
            $cart_user_id = $cart_user->getId();
            $cart_product = $this->em->getRepository(CartProduct::class)->findBy(['cart' => $cart_user_id]);

            if (!empty($cart_product)) {
                $cart = $cart_user->getCartProducts();
                return $cart;
            }
            return $cart_product;
        }
        return $cart_user;
    }
}