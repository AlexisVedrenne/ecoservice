<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaiementController extends AbstractController
{
    /**
     * @Route("/paiementvalidated", name="paiement")
     */
    public function index(): Response
    {
        
        return $this->render('payment/success.html.twig');
    }
}
