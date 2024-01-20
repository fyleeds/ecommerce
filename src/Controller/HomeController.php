<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(ProductRepository $productRepository,UserRepository $userRepository): Response
    {
        $products = $productRepository->findBy([], ['createdAt' => 'DESC']);

        // Get the user object
        $user = $this->getUser();
        if ($user) {
            $userEmail = $user->getEmail();
            return $this->render('home/index.html.twig',['products'=>$products, 'user_id'=>$userEmail]);
        }
        return $this->render('home/index.html.twig',['products'=>$products, 'user_id'=>$user]);
    }
}
