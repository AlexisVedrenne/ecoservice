<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ServiceRepository;

class ProfessionalHomeController extends AbstractController
{
    /**
     * @Route("/professional/home", name="professional_home")
     */
    public function index(ServiceRepository $serviceRepository): Response
    {
            return $this->render('service/index.html.twig', [
                'services' => $serviceRepository->findAll(),
            ]);
        }    
}
