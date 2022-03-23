<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Service1Controller extends AbstractController
{
    /**
     * @Route("/service1", name="service1")
     */
    public function index(): Response
    {
        return $this->render('service1/index.html.twig', [
            'controller_name' => 'Service1Controller',
        ]);
    }
}
