<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageAdminController extends AbstractController
{
    /**
     * @Route("adminstatscustomer", name="page_admin")
     */
    public function statscustomer(): Response
    {
        return $this->render('app/statscustomeradmin.html.twig', [
            'controller_name' => 'PageAdminController',
        ]);
    }

    /**
     * @Route("adminstatsservices", name="page_admin")
     */
    public function statsservices(): Response
    {
        return $this->render('app/statsservicesadmin.html.twig', [
            'controller_name' => 'PageAdminController',
        ]);
    }
}
