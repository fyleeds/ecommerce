<?php

namespace App\Controller\Admin;

use App\Entity\CartProduct;
use App\Entity\Cart;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use App\Entity\CategoryShop;
use App\Entity\User;
use App\Entity\Product;
use App\Entity\Stock;
use App\Entity\Invoice;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $user = $this->getUser();
        if ($user){
            // dump($user->getRoles());
            foreach ($user->getRoles() as $role){
                if ($role == "ROLE_ADMIN"){
                    $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
                    return $this->redirect($adminUrlGenerator->setController(ProductCrudController::class)->generateUrl());    
                }
            }
            
            $this->addFlash('error','Accès restreint aux admins : veuillez vous connectez en admin');
            return $this->redirectToRoute('homepage');
            
        }else{
            return $this->redirect('homepage');
        }
        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Tableau de bord');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau', 'fa fa-home');
        yield MenuItem::linkToCrud('Category', 'fa-solid fa-gamepad', CategoryShop::class);
        yield MenuItem::linkToCrud('Produit', 'fa-solid fa-robot', Product::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fa-solid fa-user', User::class);
        yield MenuItem::linkToCrud('Panier utilisateurs', 'fa-solid fa-cart-shopping', Cart::class);
        yield MenuItem::linkToCrud('Panier produits', 'fa-solid fa-cart-shopping', CartProduct::class);
        yield MenuItem::linkToCrud('Stock produits', 'fa-brands fa-product-hunt', Stock::class);
        yield MenuItem::linkToCrud('Factures', 'fa-brands fa-product-hunt', Invoice::class);
    }
}
