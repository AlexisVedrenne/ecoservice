<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    /**
     * @Route("professional/service/quote/{id}", name="service_form1")
     */
    public function index(): Response
    {
        
        $form = $this->createForm(ServiceType::class,);
        $form->handleRequest($request);

        // if isSubmitted() and validated() 

        if($form->isSubmitted()){
                return $this->render('service/index.html.twig');
        }
    }

    
    /**
     * @Route("/service/{id}", name="service_show")
     */ 
    public function show($service): Reponse {

        return $this->render('service/show_service.html.twig',[
            'service' => $service
        ]);

    }

}
