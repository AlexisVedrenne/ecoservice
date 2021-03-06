<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Doctrine\ORM\EntityManagerInterface;



class UserController extends AbstractController
{
    /**
     * @Route("/homeuser", name="home_user")
     * @IsGranted("ROLE_USER")
     */
    public function index(): Response
    {
        return $this->render('app/accountuser.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }


    /**
     * @Route("/accountuser", name="account_user")
     * @IsGranted("ROLE_USER")
     */
    public function accountuser(): Response
    {
        return $this->render('app/accountuser.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/editUser", name="edit_user", methods={"GET", "POST"})
     * @IsGranted("ROLE_USER")
     *
     */
    public function edit(Request $request, EntityManagerInterface $manager): Response
    {
        $user = $this->getUser();
        if ($request->isMethod('POST')) {
            $firstname = $request->get('firstname');
            $lastname = $request->get('lastname');
            $username = $request->get('username');
            $user->setFirstName($firstname);
            $user->setLastName($lastname);
            $user->setEmail($username);
            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', 'Vos informations ont bien été modifiés');
            return $this->redirectToRoute('edit_user');
        }
        return $this->renderForm('app/user.html.twig', []);
    }
}
