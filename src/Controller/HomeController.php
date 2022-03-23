<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public $auth = false ; 
   /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {

        if ($this->auth == false){
            return $this->render('home/index.html.twig', [
                'auth' => 'HomeController',
            ]);
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);

        if ($this->isGranted('ROLE_USER') == true){
            return $this->render('home/index.html.twig', [
                'auth' => $auth,
            ]);
        }
    }
}
