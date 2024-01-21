<?php
// src/Service/CartService.php
namespace App\Service;

use App\Entity\CartProduct;
use App\Entity\Product;
use App\Entity\Cart;
use Doctrine\ORM\EntityManagerInterface;

class CartService
{
    private EntityManagerInterface $em;
    private SoldUserService $soldUserService;
    public function __construct( EntityManagerInterface $em, SoldUserService $soldUserService){

        $this->em = $em;
        $this->soldUserService = $soldUserService;
    }
    public function addToCart($id,$user)
    {
        $user_id = $user->getId();

        $cart_user = $this->em->getRepository(Cart::class)->findOneBy(['user'=>$user_id]);

        $product = $this->getProduct($id);
        $product_price = $product->getPrice();
        $product_author = $product->getAuthor()->getId();

        $message="";

        if($this->soldUserService->compareSold($product_price,$user) &&  $user_id != $product_author){
        
            if (empty($cart_user)) {
                $cart_user = new Cart();
                $cart_user->setUser($user);
                $cart_user->setTotalprice(0);
                // tell Doctrine you want to (eventually) save the Product (no queries yet)
                $this->em->persist($cart_user);
            
                // actually executes the queries (i.e. the INSERT query)
                $this->em->flush();
            }

            $cart_user_id = $cart_user->getId();

            $carts_product = $this->em->getRepository(CartProduct::class)->findBy(['cart' => $cart_user_id]);

            if (empty($carts_product)) {
                $carts_product = new CartProduct();
                $carts_product->setProduct($product);
                $carts_product->setCart( $cart_user);
                $carts_product->setQuantity(1);
                $carts_product->setTotalPrice($product->getPrice());
                $this->em->persist($carts_product);
                $this->em->flush(); // Flush outside the loop to apply all changes

            }else{
                $isQuantityModified = false;

                foreach ($carts_product as $cart_product) {
                    $product_cart = $cart_product->getProduct();
                    if ($product_cart->getId() == $id) {
                        $quantity = $cart_product->getQuantity() + 1;
                        $total_price = $product_price * $quantity;
                        if ($this->soldUserService->compareSold($total_price,$user)){
                            $cart_product->setQuantity($quantity);
                            $cart_product->setTotalPrice($total_price);
                            $this->em->persist($cart_product);
                            $this->em->flush(); // Flush outside the loop to apply all changes
                            $isQuantityModified = true;
                        }else{
                            return "tu n'as pas assez d'argent pour augmenter la quantité, aucun produit supplémentaire n'a été ajouté au panier";
                        }
                        break; // Exit the loop once the product is found and updated
                    }
                }

                if (!$isQuantityModified) {
                    $newCartProduct = new CartProduct();
                    $newCartProduct->setProduct($product);
                    $newCartProduct->setCart($cart_user);
                    $newCartProduct->setQuantity(1);
                    $newCartProduct->setTotalPrice($product_price);
                    $this->em->persist($newCartProduct);
                    $this->em->flush(); // Flush outside the loop to apply all changes
                }

            }
            return $message;
        }

        return "tu n'as pas assez d'argent pour payer ce produit, aucun produit n'a été ajouté au panier";

       

    }
    public function decreaseFromCart($id,$user):string
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
                        $quantity = $cart_product->getQuantity() -1;
                        if ($quantity >=1) {
                            $cart_product->setQuantity($quantity);
                            $cart_product->setTotalPrice($product->getPrice() * $quantity );
                            $this->em->persist($cart_product);
                            $this->em->flush();
                            $message = "Quantité réduite ";
                            break; // Exit the loop once the product is found and updated
                        }else{
                            $this->em->remove($cart_product);
                            $this->em->flush(); // Flush outside the loop to apply all changes
                            $message = "Quantité réduite à 0 : Produit Supprimé";
                            break;
                        }
                    }
                }
                return $message;
            }

        }

    }
    public function removeFromCart($id,$user):void
    {
        $user_id = $user->getId();
        $cart_user = $this->em->getRepository(Cart::class)->findOneBy(['user'=>$user_id]);
        
        if (!empty($cart_user)) {

            $cart_user_id = $cart_user->getId();

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
    public function getTotalProducts($user)
    {
        $user_id = $user->getId();
        $cart_user = $this->em->getRepository(Cart::class)->findOneBy(['user'=>$user_id]);
        if (!empty($cart_user)) {
            $cart_user_id = $cart_user->getId();
            $carts_product = $this->em->getRepository(CartProduct::class)->findBy(['cart' => $cart_user_id]);
            
            if (!empty($carts_product)) {

                $cart = $cart_user->getCartProducts();
                return $cart;
            }
            return $carts_product;
        }
        return $cart_user;
    }
    public function calculateTotalPrice($user)
    {
        $user_id = $user->getId();
        $cart_user = $this->em->getRepository(Cart::class)->findOneBy(['user'=>$user_id]);
        if (!empty($cart_user)) {
            $cart_user_id = $cart_user->getId();
            $carts_product = $this->em->getRepository(CartProduct::class)->findBy(['cart' => $cart_user_id]);
            
            if (!empty($carts_product)) {

                $total = 0;
                foreach ($carts_product as $cart_product) {
                    $total += $cart_product->getTotalPrice();
                }
                $cart_user->setTotalprice($total);
                $this->em->persist($cart_user);
                $this->em->flush();

                return $total;
            }
            return 0;
        }
        return 0;
    }
    public function getTotalPrice($user_id)
    {
        $cart_user = $this->em->getRepository(Cart::class)->findOneBy(['user'=>$user_id]);

        if (!empty($cart_user)) {
            return $cart_user->getTotalprice();
        }
        return 0;
    }
    public function getCart($user_id)
    {
        $cart_user = $this->em->getRepository(Cart::class)->findOneBy(['user'=>$user_id]);

        if (!empty($cart_user)) {

            $cart_user_id = $cart_user->getId();
            $carts_product = $this->em->getRepository(CartProduct::class)->findBy(['cart' => $cart_user_id]);
            
            if (!empty($carts_product)) {
                return $carts_product;
            }else{
                return [];
            }
        }
        return [];
    }
    public function getProduct($id)
    {
        $product = $this->em->getRepository(Product::class)->findOneBy(['id'=>$id]);

        if (!empty($product)) {

            return $product;
        }
        return [];
    }
}