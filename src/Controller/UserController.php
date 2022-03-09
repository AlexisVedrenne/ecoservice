<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class UserController extends AbstractController
{
    /**
     * @Route("/homeuser", name="home_user")
     */
    public function index(): Response
    {
        return $this->render('app/accountuser.html.twig', [
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

    /**
     * @Route("/editUser", name="account_user", methods={"GET", "POST"})
     *
     */
    public function edit( Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $user = $this->getUser();
        if ($request->isMethod('POST')) {
            $firstname=$request->get('firstname');
            $lastname=$request->get('lastname');
            $username=$request->get('username');
            $user->setFirstName($firstname);
            $user->setLastName($lastname);
            $user->setEmail($username);
            $entityManager->flush();
            
            echo('Vos informationq ont bien été modifiés');
            //return $this->renderForm('app/user.html.twig', [
            
            

            //return $this->redirectToRoute('home_user', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('app/user.html.twig', [
            
        ]);
    }
}
