<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartValidateController extends AbstractController
{
    #[Route('/cart/validate', name: 'cart_validate_index')]
    public function index(): Response
    {
        return $this->render('cart_validate/index.html.twig', [
            'controller_name' => 'CartValidateController',
        ]);
    }
}
