<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AppController extends AbstractController
{

    public function home(): Response
    {
        return $this->render('app/home.html.twig');
    }
}
