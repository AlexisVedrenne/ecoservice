<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErrorController extends AbstractController
{
    /**
     * @Route("/error", name="error")
     */
    public function index(): Response
    {
        return $this->render('error/error.html.twig', [
            'controller_name' => 'ErrorController',
        ]);
    }

    /**
     * @Route("/error403", name="error403")
     */
    public function error403(): Response
    {
        return $this->render('error/error403.html.twig', [
            'controller_name' => 'ErrorController',
        ]);
    }

      /**
     * @Route("/error404", name="error404")
     */
    public function error404(): Response
    {
        return $this->render('error/error404.html.twig', [
            'controller_name' => 'ErrorController',
        ]);
    }
}
