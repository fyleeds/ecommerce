<?php

namespace App\Controller;

use App\Service\AccountService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    #[Route('/account/{id<\d+>}', name: 'account_user_index')]
    public function account_user(): Response
    {
        // Get the user object
        $user = $this->getUser();
        // Check if the user is logged in
        if ($user) {
            return $this->render('account/index.html.twig', [
                'controller_name' => 'AccountController',
            ]);
        }
        return $this->redirectToRoute('app_login');
    }
    #[Route('/account', name: 'my_account_index')]
    public function my_account(AccountService $accountService): Response
    {
        // Get the user object
        $user = $this->getUser();
        // Check if the user is logged in
        if ($user) {
            return $this->render('account/index.html.twig', [
                'products' => $accountService->getProductsUser($user),
                'invoices' => $accountService->getInvoicesUser($user),
                
            ]);
        }
        return $this->redirectToRoute('app_login');
    }
}
