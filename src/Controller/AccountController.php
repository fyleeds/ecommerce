<?php

namespace App\Controller;

use App\Service\AccountService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Service\SoldUserService;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

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
    public function my_account(UserPasswordHasherInterface $passwordHasher,SoldUserService $soldUserService, Request $request, EntityManagerInterface $entityManager,AccountService $accountService): Response
    {
        // Get the user object
        $user = $this->getUser();
        // Check if the user is logged in
        if ($user) {
            $old_user_sold = $user->getSold();
            $form = $this->createForm(UserType::class, $user);
     
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                $user = $form->getData();

                $plainPassword = $form->get('plainPassword')->getData();
                $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
                $user->setPassword($hashedPassword);

                if (!$soldUserService->compareSold($old_user_sold,$user)){
                    $this->addFlash('error', "You cannot set your sold down only up : Changes have been applied except for the sold");
                    $user->setSold($old_user_sold);
                }else{
                    $this->addFlash('success', "Success : Changes have been applied");
                }
                
                $entityManager->persist($user);
                $entityManager->flush();

                return $this->redirectToRoute('my_account_index');
            }
            
            return $this->render('account/index.html.twig', [
                'products' => $accountService->getProductsUser($user),
                'invoices' => $accountService->getInvoicesUser($user),
                'user_id'=> $user->getId(),
                'form' => $form ->createView(),
            ]);
        }
        return $this->redirectToRoute('app_login');
    }
}
