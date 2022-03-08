<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/homeuser", name="home_user")
     */
    public function index(): Response
    {
        return $this->render('app/homeuser.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/accountuser", name="account_user")
     */
    public function accountuser(): Response
    {
        return $this->render('app/accountuser.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
