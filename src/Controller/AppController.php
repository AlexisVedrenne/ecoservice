<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
                } else if ($role == 'ROLE_COM') {
                    return $this->redirectToRoute('admin_gestion_devis');
                }
            }
            return $this->redirectToRoute('particular');
        }
        return $this->render('app/home.html.twig');
    }

    /**
     * @Route("/particular",name="particular")
     */
    public function homeParticular($error = null, ProductRepository $repo)
    {
        return $this->render('app/homeparticular.html.twig', ['products' => $repo->findAll(), 'error' => $error]);
    }

    /**
     * $longueur : Cette variable représente la longeur du code que l'on veut générer
     * 
     * Cette fonction permet de génerer un code de façon aléatoire
     * 
     * @return int Retourne le code générer
     */
    public static function codeGen($longueur)
    {
        $number = "0123456789";
        return substr(str_shuffle(str_repeat($number, $longueur)), 0, $longueur);
    }

    /**
     * @Route("/professionnal" ,name="professionnal")
     */
    public function homePro(ServiceRepository $serviceRepository)
    {
        return $this->render('app/homepro.html.twig' , [
            'services' => $serviceRepository->findAll(),
        ]);
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

    public function register(): Response
    {

        return $this->render('templates\registration\register.html.twig');
    }
}
