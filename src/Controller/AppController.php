<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ServiceRepository;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function home(): Response
    {
        $user = $this->getUser();
        if ($user) {
            foreach ($user->getRoles() as $role) {
                if ($role == 'ROLE_ADMIN') {
                    return $this->redirectToRoute('admin_stats_customer');
                }
            }
            return $this->redirectToRoute('particular');
        }
        return $this->render('app/home.html.twig');
    }

    /**
     * @Route("/particular" ,name="particular")
     */
    public function homeParticular(ProductRepository $repo)
    {
        return $this->render('app/homeparticular.html.twig', ['products' => $repo->findAll()]);
    }

    /**
     * @Route("/professionnal" ,name="professionnal")
     */
    public function homePro(ServiceRepository $service)
    {
        return $this->render('app/homepro.html.twig',['services'=> $service->findAll()]);
    }

    /**
     * @Route("mentionlegales", name="mention_legales")
     */
    public function legalmention(): Response
    {
        return $this->render('app/legalmention.html.twig', [
            'controller_name' => 'AppController',
        ]);
    }

    /**
     * @Route("faq", name="page_faq")
     */
    public function FAQ(): Response
    {
        return $this->render('app/faq.html.twig', [
            'controller_name' => 'AppController',
        ]);
    }

    /**
     * @Route("aproposdenous", name="page_a_propos_de_nous")
     */
    public function Aboutus(): Response
    {
        return $this->render('app/aboutus.html.twig', [
            'controller_name' => 'AppController',
        ]);
    }

    /**
     * @Route("panier", name="panier")
     */
    public function ShoppingCart(): Response
    {
        return $this->render('app/shoppingcart.html.twig', [
            'controller_name' => 'AppController',
        ]);
    }

    public function register(): Response
    {

        return $this->render('templates\registration\register.html.twig');
    }

    
}
