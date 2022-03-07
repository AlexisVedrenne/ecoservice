<?php

namespace App\Controller;

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
        return $this->render('app/home.html.twig');
    }

     
    public function register(): Response{

        return $this->render('templates\registration\register.html.twig');
    }

    
}
