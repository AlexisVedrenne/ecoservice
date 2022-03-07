<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contact;
use App\Form\ContactFormType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index( Request $request): Response
    {
        $contact = new Contact() ; 
        $form = $this->createForm(ContactFormType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            
            $contact = $form->getData();
            return $this->redirectToRoute('contact',['succesMessage'=>'Message bien envoyé']);

        }else{
            return $this->render('contact/index.html.twig', ['form' => $form->createView()
        ]);
        }
        

    }

    
}
