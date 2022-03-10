<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contact;
use App\Form\ContactFormType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\MailJetApi;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createFormBui(ContactFormType::class, $contact);
        $form->handleRequest($request);
        $state = false;
        $msg='';


        if( $form->isSubmitted() ){
         
               
            if ( ($request->request->get('mail') == null) ) {

                return $this->render('contact/index.html.twig');
            } 
            else {
                
                MailJetApi::send(
                    $request->request->get('mail'),
                    $request->request->get('name'),
                    $request->request->get('objet'),
                    $request->request->get('message'),

                );
                

                $state = true;
                $msg='Message bien envoyé';
            }
        }
        return $this->render('contact/index.html.twig',['form' => $form->createView(),'state'=>$state,'message'=>$msg]);
    }
}

