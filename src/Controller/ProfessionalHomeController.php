<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfessionalHomeController extends AbstractController
{
    /**
     * @Route("/professional/home", name="professional_home")
     */
    public function index(): Response
    {
        return $this->render('professional_home/index.html.twig', [
            'controller_name' => 'ProfessionalHomeController',
        ]);
    }
}
