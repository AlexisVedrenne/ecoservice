<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\MailJetApi;
use DateTime;
use Exception;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        try {

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                // encode the plain password
                $user->setRoles(['ROLE_USER']);
                $user->setDateCreate(new DateTime('NOW'));
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('plainPassword')->getData()
                    )
                );

                $entityManager->persist($user);
                $entityManager->flush();
                // do anything else you need here, like send an email
                MailJetApi::envoie($user, 'Création de compte', 'Compte EcoService', 'Vous avez créer un compte');
                return $this->redirectToRoute('index');
            }

            return $this->render('registration/register.html.twig', [
                'registrationForm' => $form->createView(), 'error' => null
            ]);
        } catch (Exception $e) {
            return $this->render('registration/register.html.twig', [
                'registrationForm' => $form->createView(), 'error' => $e->getMessage()
            ]);
        }
    }
}
