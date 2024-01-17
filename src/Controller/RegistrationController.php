<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;


class RegistrationController extends AbstractController
{

    private RequestStack $requeststack;
    public function __construct(RequestStack $requestStack){

        $this->requeststack = $requestStack;
    }

    #[Route('/register', name: 'register_index')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $user->setSold(0);
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            // auto login

            $token = new UsernamePasswordToken($user, 'main', $user->getRoles());
            $this->container->get('security.token_storage')->setToken($token);
            $this->requeststack->getSession()->set('_security_main', serialize($token));


            return $this->redirectToRoute('homepage');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'userEmail' => $user
        ]);
    }
}
