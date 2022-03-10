<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageProController extends AbstractController
{
    /**
     * @Route("/pagepro", name="page_pro")
     */
    public function index(): Response
    {
        return $this->render('app/homepro.html.twig', [
            'controller_name' => 'PageProController',
        ]);
    }

     /**
     * @Route("/catalogueservice", name="catalogue_service")
     */
    public function indexcatalogue(): Response
    {
        return $this->render('service/servicescatalogue.html.twig', [
            'controller_name' => 'PageProController',
        ]);
    }

     /**
     * @Route("/detailservice", name="détail_service")
     */
    public function indexdétailservice(): Response
    {
        return $this->render('app/detailservices.html.twig', [
            'controller_name' => 'PageProController',
        ]);
    }
}
