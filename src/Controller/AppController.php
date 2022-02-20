<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    public function home():Response{
        return $this->render('app/homeparticular.html.twig');
    }

    /**
     * @Route("mentionlegales", name="mention_legales")
     */
    public function legalmention(): Response
    {
        return $this->render('app/legalmention.html.twig', [
            'controller_name' => 'AppController',
        ]);
    }

    /**
     * @Route("faq", name="page_faq")
     */
    public function FAQ(): Response
    {
        return $this->render('app/faq.html.twig', [
            'controller_name' => 'AppController',
        ]);
    }
}
